@extends('emails.layout')

@section('content')
<h2 style="margin:0 0 12px;font-size:18px;color:#0B1524;">New employer request</h2>
<p style="margin:0 0 16px;">{{ $employerRequest->organisation_name }} just submitted a workforce request via the Limpar Global website.</p>
<table role="presentation" width="100%" style="font-size:14px;margin-bottom:20px;border-collapse:collapse;">
<tr><td style="padding:4px 0;color:#55667A;width:140px;">Contact</td><td style="padding:4px 0;">{{ $employerRequest->contact_name }} ({{ $employerRequest->email }})</td></tr>
<tr><td style="padding:4px 0;color:#55667A;">Roles needed</td><td style="padding:4px 0;">{{ $employerRequest->roles }}</td></tr>
<tr><td style="padding:4px 0;color:#55667A;">Headcount</td><td style="padding:4px 0;">{{ $employerRequest->headcount }}</td></tr>
</table>
<a href="{{ $dashboardUrl }}" style="display:inline-block;background-color:#0A4DA6;color:#ffffff;text-decoration:none;padding:10px 20px;border-radius:8px;font-weight:bold;font-size:14px;">Review in the dashboard</a>
@endsection
