@extends('layouts.app')
@section('css')
    
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
    }

    .ticket-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        width: 50%;
    }

    .ticket-image {
        width: 100%;
        max-height: 200px;
        object-fit: cover;
        border-radius: 8px 8px 0 0;
        margin-bottom: 10px;
    }

    .ticket-barcode {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        color: #fff;
        font-size: 20px;
        font-weight: bold;
    }
    @media (max-width: 480px) {
            .ticket-container {
                width: 90%;
            }
        }
</style>
@endsection

@section('content')
<div class="ticket-container">

    <!-- Replace "path/to/your/image.jpg" with the actual path to your image -->
    <img class="ticket-image" src="{{ asset('hero-image.jpeg') }}" alt="Ticket Image">
    
    <div class="ticket-barcode my-2">
        <svg id="barcode"></svg>
    </div>

    <p class="text-center h4">Total Tiket: <span class="text-primary" style="font-size: 50px;">{{$ticket->qty}}</span></p>

    <h1 class="text-center"style="color:{{($ticket->category == 'vip')?'#007aff': 'rgba(13, 202, 240, 1)'}}; font-size:50px">
        {{ strtoupper($ticket->category) }}
    </h1>
    <h4 class="text-danger text-center">TUNJUKKAN BARCODE SAAT PENUKARAN TIKET!</h4>
</div>

@endsection

@section('js')
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/plugin/barcodegen/JsBarcode.all.min.js') }}"></script>
<script>
    $(function() {
        $("#barcode").JsBarcode("{{$ticket->bar_code}}", {
            width: 1.5,
            height: 65,
            fontSize: 26,
            format: "code128",
            displayValue: true
        });
    })
</script>
@endsection

