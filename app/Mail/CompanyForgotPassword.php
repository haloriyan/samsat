<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompanyForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $company;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($company, $token)
    {
        $this->company = $company;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Atur Ulang Kata Sandi - SAMSAT SUTRA GO")
        ->view('emails.CompanyForgotPassword', [
            'company' => $this->company,
            'token' => $this->token
        ]);
    }
}
