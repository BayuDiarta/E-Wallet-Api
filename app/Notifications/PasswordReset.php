<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordReset extends Notification
{
    use Queueable;

    protected User $user;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification’s delivery channels.
     */
    public function via(): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail()
    {
        $passwordReset = DB::table('password_resets')
            ->where('email', $this->user->email)
            ->first();
                   
        return (new MailMessage())
            ->subject('E-Wallet Password Reset')
            ->markdown('mail.password-reset', [
                'user' => $this->user->full_name,
                'token' => $passwordReset->token,
            ]);
    }
}