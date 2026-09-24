@extends('emails.layout')

@section('content')
<p style="margin:0 0 16px;">Hi {{ $recipientName }},</p>
<p style="margin:0 0 20px;white-space:pre-line;">{{ $body }}</p>
<p style="margin:0;">— {{ $adminName }}<br><span style="color:#55667A;font-size:12px;">Limpar Global</span></p>
@endsection

@section('footer')
Reply directly to this email to continue the conversation with {{ $adminName }}.
@endsection
