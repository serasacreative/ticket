<!DOCTYPE html>
<html>
<head>
    <title>TICKET MAHAFEST</title>

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>
<body>

<div style="text-align: center; background-color: #fff">
    <div style="border: 1px solid #ced4da; border-radius: 0.25rem; max-width: 400px; margin: 0 auto;">
        <div style="background-color: #f8f9fa; padding: 0.75rem 1.25rem;">
            <h6 style="margin: 0; font-size: 1.125rem; font-weight: bold;">Informasi Tiket</h6>
            <img style="max-width: 50%; display: block; margin: 10px auto;" src="{{asset('Logo-Mahafest.png')}}" alt="">
        </div>
        <div style="padding: 1.25rem;">
            <ul style="list-style: none; padding: 0;">
                <li style="border-bottom: 1px solid #ced4da; padding: 0.5rem 0;">Nama : {{$ticket->name}} </li>
                <li style="border-bottom: 1px solid #ced4da; padding: 0.5rem 0;">Kategori : {{ $ticket->categori }}</li>
                <li style="border-bottom: 1px solid #ced4da; padding: 0.5rem 0;">Jumlah Tiket : {{$ticket->qty}}</li>
                <li style="padding: 0.5rem 0;">
                    <p style="color: #17a2b8; margin: 0;">Dapatkan tiket anda dengan klik</p> 
                    <a href="https://ticket.serasacreative.com/ticket/generate/{{$url}}" style="background-color: #007bff; color: #fff; text-decoration: none; padding: 0.5rem 1rem; border-radius: 0.25rem; display: inline-block; margin-top: 5px;">Tiket Saya</a>
                </li>
            </ul>
        </div>
    </div>
</div>
</body>

</html>