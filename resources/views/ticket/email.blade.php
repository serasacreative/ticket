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
                <img class="img-fluid img-thumbnail w-50 mx-auto mt-2" src="{{asset('Logo-Mahafest.png')}}" alt="">
            </div>
            <div class="card-body">
                <ul class="list-group list-group-custom">
                    <li class="list-group-item">Nama : aku </li>
                    <li class="list-group-item">Kategori : VIP</li>
                    <li class="list-group-item">Jumlah Tiket : 3</li>
                    <li class="list-group-item">
                        <p class="bg-light">Dapatkan tiket anda dengan klik</p> 
                        <a href="{{route('ticket.vip')}}" class="btn btn-outline-primary">Tiket Saya</a>
                    </li>
                </ul>
            </div>
            
        </div>
</body>

</html>