@extends('layouts.app')
@section('css')
    
<style>
    @page {
        size: auto;
        margin: 0mm;
    }

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
        border: 2px solid #000;
        background-color: #fff;
        width: 300px;
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
        background-color: #000;
        color: #fff;
        border-radius: 0 0 8px 8px;
        font-size: 20px;
        font-weight: bold;
    }
</style>
@endsection

@section('content')
<div class="ticket-container">
    <!-- Replace "path/to/your/image.jpg" with the actual path to your image -->
    <img class="ticket-image" src="{{ asset('hero-image.jpeg') }}" alt="Ticket Image">
    
    <div class="ticket-barcode">
        <svg id="barcode"></svg>
    </div>

    <p>Total Tiket: <p class="h3 text-primary">{{$ticket->qty}}<p></p>
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

