<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    protected $password;

    protected $user;

    public function __construct(User $user, string $password)
    {
        $this->password = $password;
        $this->user = $user;
    }

    public function build()
    {
        $servername = config('blackout.game_name');

        return $this->subject(trans('emails.password_reset.subject', ['servername' => $servername]))
            ->view('emails.password_reset', [
                'password' => $this->password,
                'servername' => $servername,
                'user' => $this->user,
            ]);
    }
}
