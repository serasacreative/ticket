<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ticket;
use App\Mail\MyCustomEmail;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ticket.index');
    }

    public function ticket_festival()
    {
        return view('ticket.festival');
    }

    public function ticket_vip()
    {
        return view('ticket.vip');
    }

    public function checkout_festival(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'qty' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $price = 100000;
        $ticket = new Ticket();
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->phone = $request->phone;
        $ticket->category = 'vip';
        $ticket->status = 'pending';
        $ticket->qty = $request->qty;
        $ticket->price = $price;
        $ticket->total_price = $request->qty * $price;
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
        try {
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
                'first_name' => $ticket->name,
                'last_name' => '',
                'email' => $ticket->email,
                'phone' => $ticket->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
    } catch (\Throwable $e) {
        // Handle any exceptions that occur during the API call
        return redirect()->back()->with('error', 'Failed ! Please try again later.')->withInput();
    }

        return view('ticket.checkout', compact('snapToken', 'ticket'));
    }
    public function checkout_vip(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'qty' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $price = 130000;
        $ticket = new Ticket();
        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->phone = $request->phone;
        $ticket->category = 'vip';
        $ticket->status = 'pending';
        $ticket->qty = $request->qty;
        $ticket->price = $price;
        $ticket->total_price = $request->qty * $price;
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
        try {
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
                'first_name' => $ticket->name,
                'last_name' => '',
                'email' => $ticket->email,
                'phone' => $ticket->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
    } catch (\Throwable $e) {
        // Handle any exceptions that occur during the API call
        return redirect()->back()->with('error', 'Failed ! Please try again later.')->withInput();
    }

        return view('ticket.checkout', compact('snapToken', 'ticket'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id.$request->status_code.$request->gross_amount.$serverKey);

        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture' || $request->transaction_status == 'settlement'){
                $ticket = Ticket::find($request->order_id);
                $ticket->status = 'paid';
                $ticket->bar_code = str_pad($ticket->id, 5, "0", STR_PAD_LEFT). "-" . Carbon::parse($ticket->created_at)->format("Ymd") . "-" . strtoupper(Str::random(4));
                $ticket->save();

                $recipientEmail = $ticket->email;
                Mail::to($recipientEmail)->send(new MyCustomEmail($request->order_id));
            }
        }
    }

    public function generate($id){
        $id = Crypt::decrypt($id);

        $ticket = Ticket::find($id);
        return view('ticket.generate', compact('ticket'));
    }

    public function scan()
    {
        return view('ticket.scan');
    }

    public function verify(Request $request)
    {
        $ticket = Ticket::where('bar_code', $request->barcode)->where('status', '<>', 'scanned')->first();
        if($ticket){
            $ticket->status = 'scanned';
            $ticket->save();
            return $ticket;
        }   
        return $data['status'] = false;
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
