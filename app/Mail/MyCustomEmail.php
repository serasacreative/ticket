<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MyCustomEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Get the message content definition.
     */

    public function build()
    {
        return $this->view('emails.my_custom_email')
            ->subject('Ticket Notification')
            ->with([
                'url' => 'https://ticket.muallem.id',
            ]);
    }

}
