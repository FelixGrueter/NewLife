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
                                Kontaktanfrage
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
                                    <td style="border-top:1px solid #d4e0cc;padding-top:18px;">
                                        <div style="font-size:11px;letter-spacing:0.18em;text-transform:uppercase;color:#4a7c3f;margin-bottom:6px;">Nachricht</div>
                                        <div style="padding:16px 18px;background:#f0f5ec;
                                                    border-left:3px solid #a8c686;
                                                    white-space:pre-line;font-size:15px;line-height:1.75;color:#2a3e2c;">
                                            <?= htmlspecialchars($message) ?>
                                        </div>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:18px 32px 24px;
                                   font-family:Arial,Helvetica,sans-serif;
                                   font-size:12px;color:#6b8c6e;
                                   background:#f5f7f4;
                                   border-top:1px solid #d4e0cc;">
                            Diese Nachricht wurde über das Kontaktformular auf
                            <strong>newlife-international.org</strong> gesendet.<br>
                            Bitte direkt auf diese E-Mail antworten, um mit der Person in Kontakt zu treten.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>
</body>

</html>
