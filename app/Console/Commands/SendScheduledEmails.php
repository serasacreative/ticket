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
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send scheduled emails with a delay of 2 minutes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
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
