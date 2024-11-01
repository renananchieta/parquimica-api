<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function attachments(): array
    {
        return [];
    }

    
    public function build()
    {
        return $this
        ->from($this->details['from'], $this->details['from-name'])
        ->subject($this->details['subject'])
        ->markdown($this->details['template'])
        ->with('details', $this->details);
                    
    }
}
