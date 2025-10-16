<?php

namespace App\Jobs\Auth;

use App\Mail\Auth\PasswordResetMail;
use App\Models\Professional;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPasswordResetJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected Professional $professional,
        protected string $token
    ) {}

    public function handle(): void
    {
        $email = new PasswordResetMail($this->token);

        Mail::to($this->professional)->send($email);
    }
}
