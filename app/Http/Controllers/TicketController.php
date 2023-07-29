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

use Illuminate\Support\Facades\Log;
use Exception;



class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $is_presale = env('IS_PRESALE');
        return view('ticket.index', compact('is_presale'));
    }

    public function ticket_festival()
    {
        $tickets = Ticket::where('category', 'festival')
        ->where(function ($query) {
            $query->where('status', 'paid')
                ->orWhere('status', 'scanned');
        })
        ->sum('qty');
        $max_tickets = env('MAX_FESTIVAL_TICKET');
        if($tickets >= $max_tickets){
            return view('ticket.festival_soldout');
        }
        $price = env('FESTIVAL_TICKET_PRICE');
        $is_presale = env('IS_PRESALE');
        return view('ticket.festival', compact('price', 'is_presale'));
    }

    public function ticket_vip()
    {
        $tickets = Ticket::where('category', 'vip')
        ->where(function ($query) {
            $query->where('status', 'paid')
                ->orWhere('status', 'scanned');
        })
        ->sum('qty');
        $max_tickets = env('MAX_VIP_TICKET');
        if($tickets >= $max_tickets){
            return view('ticket.vip_soldout');
        }
        $price = env('VIP_TICKET_PRICE');
        $is_presale = env('IS_PRESALE');
        return view('ticket.vip', compact('price', 'is_presale'));
    }

    public function checkout_festival(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'qty' => 'required|numeric|max:10|min:1',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $price = env('FESTIVAL_TICKET_PRICE');
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
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
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

    $currentDate = Carbon::now()->format('M d, Y');

        return view('ticket.checkout', compact('snapToken', 'ticket', 'currentDate'));
    }
    public function checkout_vip(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'qty' => 'required|numeric|max:10|min:1',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // $price = 130000;
        $price = env('VIP_TICKET_PRICE');
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
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
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
    $currentDate = Carbon::now()->format('M d, Y');

        return view('ticket.checkout', compact('snapToken', 'ticket', 'currentDate'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
    
        if ($hashed === $request->signature_key) {
            if ($request->transaction_status === 'capture' || $request->transaction_status === 'settlement') {
                $ticket = Ticket::find($request->order_id);
                if ($ticket) {
                    $ticket->status = 'paid';
                    $ticket->bar_code = str_pad($ticket->id, 5, "0", STR_PAD_LEFT). Carbon::parse($ticket->created_at)->format("Ymd"). strtoupper(Str::random(4));
                    $ticket->save();
    
                    try {
                        // Send email with barcode
                        $recipientEmail = $ticket->email;
                        Mail::to($recipientEmail)->send(new MyCustomEmail($request->order_id));
                    } catch (Exception $e) {
                        // Log the error message
                        Log::error('Error sending email: ' . $e->getMessage());
                    }
                } else {
                    // Log ticket not found
                    Log::error('Ticket with ID ' . $request->order_id . ' not found.');
                }
            }
        }
    
        return 'salah';
    }

    public function invoice($id){
        $ticket = Ticket::find($id);

        $currentDate = Carbon::now()->format('M d, Y');
        return view('ticket.invoice', compact('ticket', 'currentDate'));

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
            return response()->json(['valid' => true, 'data' => $ticket]);
        }   
        return response()->json(['valid' => false]);
    }

    public function admin(){
        $ticket_pending = Ticket::where('status', 'pending')->sum('qty');
        $ticket_paid = Ticket::where('status', 'paid')->sum('qty');
        $ticket_paid_total = Ticket::where('status', 'paid')->sum('total_price');
        $ticket_scanned = Ticket::where('status', 'scanned')->sum('qty');
        $ticket_scanned_total = Ticket::where('status', 'scanned')->sum('total_price');

        return view('ticket.admin', compact('ticket_pending', 'ticket_paid', 'ticket_scanned', 'ticket_paid_total', 'ticket_scanned_total'));
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
