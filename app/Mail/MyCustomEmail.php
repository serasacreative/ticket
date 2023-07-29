<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MyCustomEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $order_id;
    /**
     * Create a new message instance.
     */
    public function __construct($order_id)
    {
        $this->order_id = $order_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order_id = $this->order_id;
        // $ticket = Ticket::find($order_id);
        return $this->view('emails.my_custom_email')
            ->subject('Ticket Notification')
            ->with([
                'ticket' => $order_id
            ]);
    }
}
