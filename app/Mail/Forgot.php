<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Forgot extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$new_password)
    {
       $this->email = $email;
       $this->new_password = $new_password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("support@ishopsaz.com")->view('mail.forgotpassword',[ 'email' => $this->email,'password'=> $this->new_password])->subject('فراموشی رمز عبور');
    }
}
