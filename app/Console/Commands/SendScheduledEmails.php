<?php

namespace App\Console\Commands;

use App\Models\Email;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\MyCustomEmail;
use Exception;

class SendScheduledEmails extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = Email::where('status', 'pending')->first();
        
        if ($email) {
            try {
                // Send email with barcode
                Mail::to($email->email)->send(new MyCustomEmail($email->order_id));

                // Update the status of the email to "sent" after successfully sending
                $email->status = 'sent';
                $email->save();
            } catch (Exception $e) {
                // Log the error message
                Log::error('Error sending email: ' . $e->getMessage());
            }
        }
    }
}
