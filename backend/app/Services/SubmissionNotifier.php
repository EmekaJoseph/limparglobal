<?php

namespace App\Services;

use App\Mail\EmployerRequestReceivedMail;
use App\Mail\NewEmployerRequestAdminMail;
use App\Mail\NewTalentApplicationAdminMail;
use App\Mail\TalentApplicationReceivedMail;
use App\Models\EmployerRequest;
use App\Models\SiteSetting;
use App\Models\TalentApplication;
use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

/**
 * Sends the "someone submitted a form" notification emails. A submission
 * must always succeed even if mail delivery is broken or unconfigured, so
 * every send is best-effort: failures are logged, never thrown.
 */
class SubmissionNotifier
{
    public function talentApplicationSubmitted(TalentApplication $application): void
    {
        $this->sendSafely(fn () => Mail::to(SiteSetting::adminRecipients())
            ->send(new NewTalentApplicationAdminMail($application)));

        $this->sendSafely(fn () => Mail::to($application->email)
            ->send(new TalentApplicationReceivedMail($application)));
    }

    public function employerRequestSubmitted(EmployerRequest $employerRequest): void
    {
        $this->sendSafely(fn () => Mail::to(SiteSetting::adminRecipients())
            ->send(new NewEmployerRequestAdminMail($employerRequest)));

        $this->sendSafely(fn () => Mail::to($employerRequest->email)
            ->send(new EmployerRequestReceivedMail($employerRequest)));
    }

    private function sendSafely(Closure $send): void
    {
        try {
            $send();
        } catch (Throwable $e) {
            Log::error('Notification email failed to send: '.$e->getMessage());
        }
    }
}
