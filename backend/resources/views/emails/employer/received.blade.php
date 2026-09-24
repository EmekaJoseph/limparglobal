@extends('emails.layout')

@section('content')
<h2 style="margin:0 0 12px;font-size:18px;color:#0B1524;">Thanks for reaching out, {{ $employerRequest->contact_name }}!</h2>
<p style="margin:0 0 16px;">We've received {{ $employerRequest->organisation_name }}'s request for support with <strong>{{ $employerRequest->roles }}</strong>. Our team will review the details and be in touch shortly.</p>
<p style="margin:0;">If anything changes in the meantime, feel free to reply to this email.</p>
@endsection

@section('footer')
This confirms we've received your request. No action is needed from you right now.
@endsection
