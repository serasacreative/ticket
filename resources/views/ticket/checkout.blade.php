@extends('layouts.app')

@section('css')
 <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
 <script type="text/javascript"
 src="{{config('midtrans.snap_url')}}"
 data-client-key="{{config('midtrans.client_key')}}"></script>
    
@endsection

@section('content')
    <div class="container-fluid">

        <div class="block-header py-lg-4 py-3">
            <div class="row g-3">
                <div class="col-md-6 col-sm-12">
                    <h2 class="m-0 fs-5"><a href="{{route('ticket.index')}}" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Beranda</h2>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{route('ticket.index')}}">Beranda</a></li>
                        <li class="breadcrumb-item active">Ticket Chcckout</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Checkout Tiket anda !</h6>
                    </div>
                    
                    <div class="card-body">
                        <h3>Invoice Details:</h3>
                        <div class="w-100 row">
                            <div class="col-md-6 col-sm-6">
                                <address>
                                    Nama : {{$ticket->name}}<br>
                                    <strong>Email : {{$ticket->email}}</strong><br>
                                    <abbr title="Phone">No HP : </abbr> {{$ticket->phone}} 
                                </address>
                            </div>
                            <div class="col-md-6 col-sm-6 text-end">
                                <p class="mb-0"><strong>Order Tanggal : </strong> {{$currentDate}}</p>
                                <p class="mb-0"><strong>Order Status: </strong> <span class="badge bg-warning">{{$ticket->status}}</span></p>
                                <p><strong>Order ID: </strong> {{$ticket->id}}</p>
                            </div>
                        </div>
                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="details" role="tabpanel">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kategori</th>
                                                        <th>Jumlah Tiket</th>
                                                        <th class="hidden-sm-down">Harga Satuan</th>
                                                        <th>Harga Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>{{$ticket->category}}</td>
                                                        <td>{{$ticket->qty}}</td>
                                                        <td class="hidden-sm-down">RP {{$ticket->price}}</td>
                                                        <td>Rp {{$ticket->total_price}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Note</h5>
                                        <p>Tiket akan dikirim ke email anda.</p>
                                        <p>Tukarkan tiket untuk mendapatkan mercandise pada tanggal 27 Agustus 2023.</p>
                                    </div>
                                    <div class="col-md-12 text-end">
                                        <button class="btn btn-primary" id="pay-button">Checkout</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
      window.snap.pay('{{$snapToken}}', {
        onSuccess: function(result){
          /* You may add your own implementation here */
          window.location.href = 'https://ticket.serasacreative.com/ticket/invoice/'+result.order_id
        },
        
        onError: function(result){
          /* You may add your own implementation here */
          alert("Pembayaran Gagal!"); 
        },
        onClose: function(){
          /* You may add your own implementation here */
          alert('Anda menutup pembayaran tanpa menyelesaikannya!');
        }
      })
    });
  </script>
@endsection
