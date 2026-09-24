@extends('emails.layout')

@section('content')
<h2 style="margin:0 0 12px;font-size:18px;color:#0B1524;">Thanks for applying, {{ $application->full_name }}!</h2>
<p style="margin:0 0 16px;">We've received your application to join the Limpar Global talent pool for <strong>{{ $application->area_of_interest }}</strong>. Our team will review your profile and reach out if there's a good fit.</p>
<p style="margin:0;">In the meantime, feel free to follow us on <a href="https://www.linkedin.com/company/limpar-global/" style="color:#0A4DA6;">LinkedIn</a> for updates.</p>
@endsection

@section('footer')
This confirms we've received your application. No action is needed from you right now.
@endsection
