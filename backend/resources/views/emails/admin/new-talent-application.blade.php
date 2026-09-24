@extends('emails.layout')

@section('content')
<h2 style="margin:0 0 12px;font-size:18px;color:#0B1524;">New talent application</h2>
<p style="margin:0 0 16px;">{{ $application->full_name }} just applied via the Limpar Global website.</p>
<table role="presentation" width="100%" style="font-size:14px;margin-bottom:20px;border-collapse:collapse;">
<tr><td style="padding:4px 0;color:#55667A;width:140px;">Email</td><td style="padding:4px 0;">{{ $application->email }}</td></tr>
<tr><td style="padding:4px 0;color:#55667A;">Area of interest</td><td style="padding:4px 0;">{{ $application->area_of_interest }}</td></tr>
<tr><td style="padding:4px 0;color:#55667A;">Experience</td><td style="padding:4px 0;">{{ $application->experience_range }}</td></tr>
</table>
<a href="{{ $dashboardUrl }}" style="display:inline-block;background-color:#0A4DA6;color:#ffffff;text-decoration:none;padding:10px 20px;border-radius:8px;font-weight:bold;font-size:14px;">Review in the dashboard</a>
@endsection
