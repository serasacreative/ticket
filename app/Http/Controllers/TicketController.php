<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Mail\MyCustomEmail;
use Illuminate\Support\Facades\Mail;


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ticket.index');
    }

    public function checkout(Request $request)
    {
        $ticket = new Ticket();
        $ticket->email = $request->email;
        $ticket->status = 'pending';
        $ticket->qty = $request->qty;
        $ticket->price = $request->price;
        $ticket->total_price = $request->qty * $request->price;
        $ticket->created_at = Carbon::now();
        $ticket->updated_at = Carbon::now();
        $ticket->save();

        /*Install Midtrans PHP Library (https://github.com/Midtrans/midtrans-php)
        composer require midtrans/midtrans-php
                                    
        Alternatively, if you are not using **Composer**, you can download midtrans-php library 
        (https://github.com/Midtrans/midtrans-php/archive/master.zip), and then require 
        the file manually.   

        require_once dirname(__FILE__) . '/pathofproject/Midtrans.php'; */

        //SAMPLE REQUEST START HERE

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $ticket->id,
                'gross_amount' => $ticket->total_price,
            ),
            'customer_details' => array(
                'first_name' => $ticket->email,
                'last_name' => '',
                'email' => $ticket->email,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('ticket.checkout', compact('snapToken', 'ticket'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id.$request->status_code.$request->gross_amount.$serverKey);

        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture'){
                $ticket = Ticket::find($request->order_id);
                $ticket->status = 'paid';
                $ticket->save();


                $recipientEmail = $ticket->email;
                Mail::to($recipientEmail)->send(new MyCustomEmail());
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
