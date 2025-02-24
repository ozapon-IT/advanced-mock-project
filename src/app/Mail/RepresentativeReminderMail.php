<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Shop;
use Illuminate\Support\Collection;

class RepresentativeReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $shop;
    public $reservations;

    /**
     * Create a new message instance.
     */
    public function __construct(Shop $shop, Collection $reservations)
    {
        $this->shop = $shop;
        $this->reservations = $reservations;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '【Rese】本日のご予約リスト',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.representative-reminder',
        );
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
