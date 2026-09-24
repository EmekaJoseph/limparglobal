<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0;padding:0;background-color:#EAF4FB;font-family:'Segoe UI',Arial,Helvetica,sans-serif;color:#0B1524;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#EAF4FB;padding:32px 16px;">
<tr>
<td align="center">
<table role="presentation" width="100%" style="max-width:560px;background-color:#ffffff;border-radius:12px;overflow:hidden;">
<tr>
<td style="background-color:#0A4DA6;padding:20px 28px;">
<span style="color:#ffffff;font-size:18px;font-weight:bold;">Limpar Global</span>
</td>
</tr>
<tr>
<td style="padding:28px;font-size:14px;line-height:1.6;">
@yield('content')
</td>
</tr>
<tr>
<td style="padding:16px 28px;background-color:#f4f7fa;font-size:12px;color:#55667A;">
@yield('footer', 'This is an automated message from the Limpar Global admin system.')
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>
