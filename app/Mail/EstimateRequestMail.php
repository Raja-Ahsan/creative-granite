<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EstimateRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array{name: string, email: string, phone: ?string, project_type: string, message: string}  $estimate
     */
    public function __construct(public array $estimate) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New estimate request — '.$this->estimate['name'],
            replyTo: [$this->estimate['email']],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.estimate-request',
        );
    }
}
