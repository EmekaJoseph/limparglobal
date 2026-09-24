<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $recipientName,
        public string $subjectLine,
        public string $bodyText,
        public string $adminName,
        public string $adminEmail,
    ) {
    }

    public function build(): self
    {
        return $this->subject($this->subjectLine)
            ->replyTo($this->adminEmail, $this->adminName)
            ->view('emails.admin.message')
            ->with([
                'recipientName' => $this->recipientName,
                'body' => $this->bodyText,
                'adminName' => $this->adminName,
            ]);
    }
}
