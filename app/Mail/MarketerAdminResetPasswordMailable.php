<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MarketerAdminResetPasswordMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $code;


    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("كود اعادة اعادة ضبط كلمة المرور "   )
            ->view('emails.marketing.reset_password'); // Define the view for the email
    }
}
