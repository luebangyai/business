<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    public $token;

    /**
     * Create a new message instance.
     */
    public function __construct($mailData, $token)
    {
        $this->mailData = $mailData;
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     */
    public function envelope()
    {
        $param = $this->mailData;
        $title = $param['title'];
        return new Envelope(
            subject: $title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content()
    {
        $param = $this->mailData;
        $token = $this->token;
        $body = $param['body'];

        if($body == 'approve'){
            return new Content(
                view: 'mail.approve',
            );
        }else if($body == 'reject'){
            return new Content(
                view: 'mail.reject',
            );
        }else{
            return new Content(
                view: 'mail.booking',
            );
        }

    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
