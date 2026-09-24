<?php

namespace App\Mail;

use App\Models\TalentApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TalentApplicationReceivedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public TalentApplication $application)
    {
    }

    public function build(): self
    {
        return $this->subject("We've received your application — Limpar Global")
            ->view('emails.talent.received')
            ->with(['application' => $this->application]);
    }
}
