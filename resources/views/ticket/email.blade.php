<!DOCTYPE html>
<html>
<head>
    <title>TICKET MAHAFEST</title>

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>
<body>
    <div style="text-align: center;">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Informasi Tiket</h6>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-custom">
                    <li class="list-group-item">Nama : {{$ticket->name}} </li>
                    <li class="list-group-item">Kategori : {{$ticket->name}}</li>
                    <li class="list-group-item">Jumlah Tiket : {{$ticket->qty}}</li>
                </ul>
            </div>
            <div class="alert alert-info" role="alert">Dapatkan tiket anda dengan klik <a href="https://ticket.serasacreative.com/ticket/generate/{{$url}}" class="btn btn-primary text-decoration-none text-white" > Tiket Saya </a></div>
        </div>
</body>

</html>