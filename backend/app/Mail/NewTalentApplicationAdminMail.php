<?php

namespace App\Mail;

use App\Models\TalentApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewTalentApplicationAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public TalentApplication $application)
    {
    }

    public function build(): self
    {
        $dashboardUrl = rtrim(config('app.frontend_url'), '/').'/admin/talent-applications/'.$this->application->id;

        return $this->subject('New talent application: '.$this->application->full_name)
            ->view('emails.admin.new-talent-application')
            ->with([
                'application' => $this->application,
                'dashboardUrl' => $dashboardUrl,
            ]);
    }
}
