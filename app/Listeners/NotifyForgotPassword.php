<?php

namespace App\Listeners;

use App\Events\ForgotPassword;
use App\Mail\ForgotPasswordMail;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyForgotPassword
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ForgotPassword $event): void
    {
        try {
            $details = $event->details;

            $url = route('reset.page', $details['token']);
            $to = $details['to'];

            $content = [
                'url' => $url,
            ];

            Mail::to($to)->send(new ForgotPasswordMail($content));

        } catch (\Exception $e) {
            Log::channel('lifeline')->error(__METHOD__ . ' ' .$e->getMessage());
            Flasher::addError('Could not send email. Please inform your administrator!!!');
        }
    }
}
