<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactSendmail extends Mailable
{
    use Queueable, SerializesModels;

    private $name;
    private $email;
    private $phone;
    private $company;
    private $category;
    private $detail;

    /**
     * Create a new message instance.
     */
    public function __construct($contactInputs)
    {
        $this->name = $contactInputs['name'];
        $this->email = $contactInputs['email'];
        $this->phone = $contactInputs['phone'];
        $this->company = $contactInputs['company'];
        $this->category = $contactInputs['category'];
        $this->detail = $contactInputs['detail'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: 'yoshikawa.engineer@gmail.com',
            subject: '自動送信メール',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'contact.mail',
            with: [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'company' => $this->company,
                'category' => $this->category,
                'detail' => $this->detail,
            ],
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
