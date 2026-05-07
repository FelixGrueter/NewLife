<?php
/**
 * New Life Contact Form Handler
 *
 * Zweck:
 * - Verarbeitet zwei Formulartypen:
 *   1. "gemeinde_finden"  → Name, E-Mail, Telefon, Land, PLZ, Ort
 *   2. "kontakt"          → Name, E-Mail, Nachricht
 * - Schützt effektiv gegen Spam & Bots
 * - Liefert konsistente JSON-Antworten
 *
 * Umgebung:
 * - Shared Hosting (z. B. all-inkl)
 * - PHP >= 7.4
 */

declare(strict_types=1);

/* --------------------------------------------------------------------------
 * Basis-Setup
 * -------------------------------------------------------------------------- */

session_start();
header('Content-Type: application/json; charset=utf-8');


/* --------------------------------------------------------------------------
 * Hilfsfunktion: reject()
 * -------------------------------------------------------------------------- */
function reject(
    int $statusCode = 400,
    string $message = 'Anfrage konnte nicht verarbeitet werden.'
): void {
    http_response_code($statusCode);
    echo json_encode([
        'success' => false,
        'message' => $message
    ]);
    exit;
}


/* --------------------------------------------------------------------------
 * 1. Honeypot-Check (BOT-Erkennung)
 *
 * - Feld "website" ist für Menschen unsichtbar
 * - Bots füllen es fast immer aus
 * - Reaktion: stillschweigend abbrechen (KEIN Feedback)
 * -------------------------------------------------------------------------- */
if (!empty($_POST['website'] ?? '')) {
    http_response_code(204);
    exit;
}


/* --------------------------------------------------------------------------
 * 2. Mindest-Ausfüllzeit (Session-basiert)
 *
 * - Menschen brauchen Zeit zum Lesen & Schreiben
 * - Bots sind zu schnell
 * -------------------------------------------------------------------------- */
$minTimeSeconds = 3;

if (
    !isset($_SESSION['form_time']) ||
    (time() - $_SESSION['form_time']) < $minTimeSeconds
) {
    reject(400);
}


/* --------------------------------------------------------------------------
 * 3. Rate-Limiting / Cooldown
 *
 * - Verhindert Doppelklicks & Flooding
 * - Gilt pro Session (shared für beide Formulare)
 * -------------------------------------------------------------------------- */
$cooldownSeconds = 30;
$now = time();

if (
    isset($_SESSION['last_submit']) &&
    ($now - $_SESSION['last_submit']) < $cooldownSeconds
) {
    reject(
        429,
        'Bitte warte einen Moment, bevor du erneut sendest.'
    );
}

$_SESSION['last_submit'] = $now;


/* --------------------------------------------------------------------------
 * 4. Formulartyp bestimmen
 * -------------------------------------------------------------------------- */
$formType = isset($_POST['form_type']) ? trim($_POST['form_type']) : '';

if (!in_array($formType, ['gemeinde_finden', 'kontakt'], true)) {
    reject(400, 'Ungültiger Formulartyp.');
}


/* --------------------------------------------------------------------------
 * 5. Gemeinsame Felder auslesen & säubern
 * -------------------------------------------------------------------------- */
$name = isset($_POST['name'])
    ? trim(strip_tags($_POST['name']))
    : '';

$emailRaw = isset($_POST['email']) ? trim($_POST['email']) : '';
$email    = filter_var($emailRaw, FILTER_VALIDATE_EMAIL) ?: '';


/* --------------------------------------------------------------------------
 * 6. Formularspezifische Felder + Validierung + Templates
 * -------------------------------------------------------------------------- */
$to        = 'info@newlife-international.org';
$fromEmail = 'noreply@newlife-international.org';

if ($formType === 'gemeinde_finden') {

    $phone   = isset($_POST['phone'])   ? trim(strip_tags($_POST['phone']))   : '';
    $country = isset($_POST['country']) ? trim(strip_tags($_POST['country'])) : '';
    $plz     = isset($_POST['plz'])     ? trim(strip_tags($_POST['plz']))     : '';
    $ort     = isset($_POST['ort'])     ? trim(strip_tags($_POST['ort']))     : '';

    if ($name === '' || $email === '' || $phone === '' || $country === '' || $plz === '' || $ort === '') {
        reject(400, 'Bitte fülle alle Felder korrekt aus.');
    }

    $subject = "New Life – Gemeinde finden: $name";

    ob_start();
    require __DIR__ . '/mail-templates/gemeinde-finden.txt.php';
    $textMessage = ob_get_clean();

    ob_start();
    require __DIR__ . '/mail-templates/gemeinde-finden.html.php';
    $htmlMessage = ob_get_clean();

} else {
    // kontakt

    $message = isset($_POST['message'])
        ? trim(strip_tags($_POST['message']))
        : '';

    if ($name === '' || $email === '' || $message === '') {
        reject(400, 'Bitte fülle alle Felder korrekt aus.');
    }

    $subject = "New Life – Kontakt: $name";

    ob_start();
    require __DIR__ . '/mail-templates/kontakt.txt.php';
    $textMessage = ob_get_clean();

    ob_start();
    require __DIR__ . '/mail-templates/kontakt.html.php';
    $htmlMessage = ob_get_clean();
}


/* --------------------------------------------------------------------------
 * 7. Mail-Vorbereitung (Multipart: Text + HTML)
 * -------------------------------------------------------------------------- */
$boundary = md5(uniqid((string)time(), true));

$headers  = "From: new Life. Webseite <$fromEmail>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "X-Entity-Ref-ID: " . uniqid('newlife-', true) . "\r\n";
$headers .= "Content-Type: multipart/alternative; boundary=\"$boundary\"\r\n";

$body  = "--$boundary\r\n";
$body .= "Content-Type: text/plain; charset=UTF-8\r\n";
$body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
$body .= $textMessage . "\r\n\r\n";

$body .= "--$boundary\r\n";
$body .= "Content-Type: text/html; charset=UTF-8\r\n";
$body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
$body .= $htmlMessage . "\r\n\r\n";
$body .= "--$boundary--";


/* --------------------------------------------------------------------------
 * 8. Mail-Versand
 *
 * - LOKAL: Logging statt mail()
 * - LIVE:  mail() aktivieren
 * -------------------------------------------------------------------------- */

// ===== LOKAL (Entwicklung / Test) =====
/*
file_put_contents(
    __DIR__ . '/mail-test.log',
    date('Y-m-d H:i:s') . ' [' . $formType . ']' . PHP_EOL .
    print_r($_POST, true) .
    PHP_EOL . "---------------------" . PHP_EOL,
    FILE_APPEND
);

echo json_encode([
    'success' => true,
    'message' => 'Mail wurde lokal simuliert.'
]);
exit;
*/

// ===== LIVE (Produktion) =====
if (mail($to, $subject, $body, $headers)) {
    echo json_encode([
        'success' => true,
        'message' => 'Deine Nachricht wurde erfolgreich versendet!'
    ]);
} else {
    reject(
        500,
        'Es gab einen Serverfehler. Bitte versuche es später erneut.'
    );
}
