<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WarrantyRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array{name: string, email: string, phone: ?string, address: ?string, message: string}  $warranty
     */
    public function __construct(public array $warranty) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New warranty request — '.$this->warranty['name'],
            replyTo: [$this->warranty['email']],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.warranty-request',
        );
    }
}
