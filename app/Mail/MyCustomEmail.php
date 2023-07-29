<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\File;
use Milon\Barcode\DNS1D;
use Exception;

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
        $ticket = Ticket::find($order_id);

        // Generate the barcode image
        $barcode = new DNS1D();
        $barcode->setStorPath(public_path('temp')); // Set the temporary storage path

        // Create the "public/temp" directory if it doesn't exist
        File::makeDirectory(public_path('temp'), 0777, true);

        $barcodeImage = $barcode->getBarcodePNG($ticket->bar_code, 'C128');

        // Save the barcode image temporarily in the public directory
        $tempImagePath = public_path('temp/barcode_'.$ticket->id.'.png');
        file_put_contents($tempImagePath, $barcodeImage);

        return $this->view('emails.my_custom_email')
            ->subject('Ticket Notification')
            ->attach($tempImagePath, [
                'as' => 'barcode.png',
                'mime' => 'image/png',
            ])
            ->with([
                'ticket' => $ticket,
            ]);
    }
}


