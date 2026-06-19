<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use App\Mail\SendOTP;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendOTPUsingEmail
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(UserLoggedIn $event): void
    {
        try {
            Mail::to($event->user->email)->send(
                new SendOTP($event->user)
            );

            Log::info('OTP email sent to: ' . $event->user->email);

        } catch (\Exception $e) {
            Log::error('Failed to send OTP email: ' . $e->getMessage());

            $this->release(10); // Retry after 10 seconds
        }
    }
}
