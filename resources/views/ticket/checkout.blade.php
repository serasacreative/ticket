@extends('layouts.app')

@section('css')
 <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
 <script type="text/javascript"
 src="https://app.sandbox.midtrans.com/snap/snap.js"
 data-client-key="{{config('midtrans.client_key')}}"></script>
    
@endsection

@section('content')
    <div class="container-fluid">

        <div class="block-header py-lg-4 py-3">
            <div class="row g-3">
                <div class="col-md-6 col-sm-12">
                    <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Tickets</h2>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="index.html">Lucid</a></li>
                        <li class="breadcrumb-item active">Ticket</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Order Your Ticket</h6>
                    </div>
                    
                    <div class="card-body">
                        <h3>Invoice Details: <strong class="text-primary">#A0089</strong></h3>
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
                                                        <th>Category</th>
                                                        <th>Qty</th>
                                                        <th class="hidden-sm-down">Price</th>
                                                        <th>Total Price</th>
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
          alert("payment success!"); console.log(result);
        },
        onPending: function(result){
          /* You may add your own implementation here */
          alert("wating your payment!"); console.log(result);
        },
        onError: function(result){
          /* You may add your own implementation here */
          alert("payment failed!"); console.log(result);
        },
        onClose: function(){
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      })
    });
  </script>
@endsection
