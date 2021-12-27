<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMailer extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $otp;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {

        $this->email = $user['email'];
        $this->otp = $user['otp'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.otp');
    }
}
