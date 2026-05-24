<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectText;
    public $messageText;
    public $filePath;

    public function __construct($subjectText, $messageText, $filePath = null)
    {
        $this->subjectText = $subjectText;
        $this->messageText = $messageText;
        $this->filePath = $filePath;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectText,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'admin.pages.email.email',
            with: [
                'subjectText' => $this->subjectText,
                'messageData' => $this->messageText,
            ]
        );
    }

    public function attachments(): array
    {
        if (!$this->filePath) {
            return [];
        }

        return [
            Attachment::fromStorageDisk('public', $this->filePath),
        ];
    }
}
