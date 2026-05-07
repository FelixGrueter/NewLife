<!doctype html>
<html lang="de">

<head>
    <meta charset="UTF-8">
</head>

<body style="margin:0;padding:0;background:#eef2eb;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#eef2eb;padding:30px 0;">
        <tr>
            <td align="center">

                <!-- Container -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;color:#1a2e1c;font-family:Georgia,'Times New Roman',serif;">

                    <!-- Header -->
                    <tr>
                        <td style="padding:28px 32px 22px;background:#1a2e1c;border-bottom:3px solid #a8c686;">
                            <div style="font-family:Georgia,serif;font-size:22px;font-weight:400;font-style:italic;color:#f0ede6;letter-spacing:0.04em;">
                                new Life.
                            </div>
                            <div style="margin-top:6px;font-family:Arial,Helvetica,sans-serif;font-size:11px;letter-spacing:0.22em;text-transform:uppercase;color:#a8c686;">
                                Anfrage — Gemeinde finden
                            </div>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:32px;">
                            <table width="100%" cellpadding="0" cellspacing="0"
                                style="font-family:Arial,Helvetica,sans-serif;font-size:15px;line-height:1.65;color:#1a2e1c;">

                                <tr>
                                    <td style="padding-bottom:18px;">
                                        <div style="font-size:11px;letter-spacing:0.18em;text-transform:uppercase;color:#4a7c3f;margin-bottom:4px;">Name</div>
                                        <div style="font-size:16px;font-weight:400;"><?= htmlspecialchars($name) ?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom:18px;border-top:1px solid #d4e0cc;padding-top:18px;">
                                        <div style="font-size:11px;letter-spacing:0.18em;text-transform:uppercase;color:#4a7c3f;margin-bottom:4px;">E-Mail</div>
                                        <div style="font-size:15px;"><?= htmlspecialchars($email) ?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-bottom:18px;border-top:1px solid #d4e0cc;padding-top:18px;">
                                        <div style="font-size:11px;letter-spacing:0.18em;text-transform:uppercase;color:#4a7c3f;margin-bottom:4px;">Telefon</div>
                                        <div style="font-size:15px;"><?= htmlspecialchars($phone) ?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-top:1px solid #d4e0cc;padding-top:18px;">
                                        <div style="font-size:11px;letter-spacing:0.18em;text-transform:uppercase;color:#4a7c3f;margin-bottom:4px;">Standort</div>
                                        <table cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="padding-right:24px;">
                                                    <div style="font-size:11px;color:#6b8c6e;margin-bottom:2px;">Land</div>
                                                    <div style="font-size:15px;"><?= htmlspecialchars(strtoupper($country)) ?></div>
                                                </td>
                                                <td style="padding-right:24px;">
                                                    <div style="font-size:11px;color:#6b8c6e;margin-bottom:2px;">PLZ</div>
                                                    <div style="font-size:15px;"><?= htmlspecialchars($plz) ?></div>
                                                </td>
                                                <td>
                                                    <div style="font-size:11px;color:#6b8c6e;margin-bottom:2px;">Ort</div>
                                                    <div style="font-size:15px;"><?= htmlspecialchars($ort) ?></div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                    <!-- Hinweis-Banner -->
                    <tr>
                        <td style="padding:0 32px 28px;">
                            <div style="background:#f0f5ec;border-left:3px solid #a8c686;padding:14px 18px;font-family:Arial,Helvetica,sans-serif;font-size:13px;color:#4a7c3f;line-height:1.6;">
                                Diese Person sucht eine Hausgemeinde in ihrer Nähe.<br>
                                Bitte direkt auf diese E-Mail antworten, um Kontakt aufzunehmen.
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:18px 32px 24px;
                                   font-family:Arial,Helvetica,sans-serif;
                                   font-size:12px;color:#6b8c6e;
                                   background:#f5f7f4;
                                   border-top:1px solid #d4e0cc;">
                            Diese Anfrage wurde über das Formular auf
                            <strong>newlife-international.org</strong> gesendet.<br>
                            new Life. — Hausgemeinde-Netzwerk | Ein Werk von MANTD
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>
</body>

</html>
