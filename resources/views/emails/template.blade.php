<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $emailSubject ?? config('app.name') }}</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f5f0ea; font-family: 'Biondi Sans', 'Helvetica Neue', Arial, sans-serif;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f5f0ea; padding: 32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellspacing="0" cellpadding="0" style="max-width: 600px; width: 100%; background-color: #ffffff; border: 1px solid #e8dfd4;">
                    <tr>
                        <td style="background-color: #2a2622; padding: 24px 32px;">
                            <p style="margin: 0; color: #f5f0ea; font-size: 18px; letter-spacing: 0.12em; text-transform: uppercase;">
                                Creative Granite &amp; Design
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 32px; color: #2a2622; font-size: 16px; line-height: 1.7;">
                            {!! $emailBody !!}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 32px; border-top: 1px solid #e8dfd4; color: #8a8278; font-size: 12px; line-height: 1.6;">
                            This email was sent from Creative Granite &amp; Design.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
