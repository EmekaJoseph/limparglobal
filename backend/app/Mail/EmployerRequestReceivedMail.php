<?php

namespace App\Mail;

use App\Models\EmployerRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmployerRequestReceivedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public EmployerRequest $employerRequest)
    {
    }

    public function build(): self
    {
        return $this->subject("We've received your request — Limpar Global")
            ->view('emails.employer.received')
            ->with(['employerRequest' => $this->employerRequest]);
    }
}
