<?php

namespace App\Mail;

use App\Models\EmployerRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewEmployerRequestAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public EmployerRequest $employerRequest)
    {
    }

    public function build(): self
    {
        $dashboardUrl = rtrim(config('app.frontend_url'), '/').'/admin/employer-requests/'.$this->employerRequest->id;

        return $this->subject('New employer request: '.$this->employerRequest->organisation_name)
            ->view('emails.admin.new-employer-request')
            ->with([
                'employerRequest' => $this->employerRequest,
                'dashboardUrl' => $dashboardUrl,
            ]);
    }
}
