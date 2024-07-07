<?php

namespace App\Jobs\User;

use App\Enums\User\Fields;
use App\Mail\WelcomeEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $receiver;

    /**
     * Create a new job instance.
     */
    public function __construct($receiver)
    {
        $this->receiver = $receiver;
    }

    public function handle()
    {
        $email = new WelcomeEmail();
        Mail::to($this->receiver)->send($email);
    }
}
