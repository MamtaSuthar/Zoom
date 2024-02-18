<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class EmailVerifyMail extends Mailable
{
    use Queueable, SerializesModels;
  
    public $details;
    public $view;
    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details, $view, $subject)
    {
        $this->details = $details;
        $this->view = $view;
        $this->subject = $subject;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->view)
                ->subject($this->subject);
                
    }
}
