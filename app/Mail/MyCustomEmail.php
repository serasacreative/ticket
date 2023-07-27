<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

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
        $order_id = Crypt::encrypt($this->order_id);
        return $this->view('emails.my_custom_email')
            ->subject('Ticket Notification')
            ->with([
                'url' => "https://ticket.muallem.id/generate/$order_id",
            ]);
    }
}
