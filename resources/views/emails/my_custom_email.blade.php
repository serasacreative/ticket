<!DOCTYPE html>
<html>
<head>
    <title>Your Email Subject</title>

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>
<body>
    <div style="text-align: center;">
        <img src="https://ticket.serasacreative.com/banner_mail.jpg" alt="Banner Image" style="max-width: 100%;">
    </div>
    
    Nama : {{$ticket->name}} 
    Kategori : {{$ticket->category}} 
    Jumlah Tiket : {{$ticket->qty}} 

    <!-- Your other HTML content -->

    <!-- Display the barcode image -->
    <img src="{{ $message->embedData($barcodeImage, 'barcode.png') }}" alt="Barcode Image" style="display: block; margin: 0 auto;">

    <!-- Your other HTML content -->
</body>
</html>
