<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactInquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array{name: string, email: string, phone: ?string, project_type: string, message: string}  $inquiry
     */
    public function __construct(public array $inquiry) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New contact inquiry — '.$this->inquiry['name'],
            replyTo: [$this->inquiry['email']],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-inquiry',
        );
    }
}
