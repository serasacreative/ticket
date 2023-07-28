@extends('layouts.app')


@section('content')
    <div class="container-fluid">

        <div class="block-header py-lg-4 py-3">
            <div class="row g-3">
                <div class="col-md-6 col-sm-12">
                    <h2 class="m-0 fs-5"><a href="{{route('ticket.index')}}" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Tickets</h2>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{route('ticket.index')}}">Ticket</a></li>
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
                        <h1> Ticket List</h1>
                        <div class="row w-100 d-flex justify-content-evenly">
                            <div class="col-lg-4 col-md-12">
                                <div class="card py-4 text-center">
                                    <div class="card-body">
                                        <img src="{{asset('assets/images/paper-plane.png')}}" alt="" class="pricing-img">
                                        <h2 class="pricing-header">Festival</h2>
                                        <ul class="pricing-features list-unstyled">
                                            <li class="my-2">Free Merchandise</li>
                                            <li class="my-2"><i class="fa fa-calendar"></i> On 27 Aug 2023</li>
                                            <li class="my-2"><i class="fa fa-clock">15:00 - 24:00 WIB</i></li>
                                        </ul>
                                        <p class="fs-2">Rp 100.000</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="card py-4 text-center">
                                    <div class="card-body">
                                        @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                            
                                        <img src="{{asset('assets/images/paper-plane.png')}}" alt="" class="pricing-img">
                                        <h2 class="pricing-header"></h2>
                                        <form method="POST" action="{{route('ticket.checkout.festival')}}">
                                            @csrf
                                            <div class="modal-body">
                                                {{-- Email --}}
                                                <div class="row align-items-end my-2 ">
                                                    <div class="col-md">
                                                        <label>Email :</label>
                                                        <input class="form-control @error('email') is-invalid @enderror" type="email" placeholder="Email" required name="email" value="{{ old('email') }}">
                                                        @error('email')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                {{-- Name --}}
                                                <div class="row align-items-end my-2 ">
                                                    <div class="col-md">
                                                        <label>Name :</label>
                                                        <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Name" required name="name" value="{{ old('name') }}">
                                                        @error('name')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                {{-- Phone --}}
                                                <div class="row align-items-end my-2 ">
                                                    <div class="col-md">
                                                        <label>Phone :</label>
                                                        <input class="form-control @error('phone') is-invalid @enderror" type="number" placeholder="Phone" required name="phone" value="{{ old('phone') }}">
                                                        @error('phone')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                {{-- QTY --}}
                                                <div class="row align-items-end my-2 ">
                                                    <div class="col-md">
                                                        <label>Quantity :</label>
                                                        <input class="form-control @error('qty') is-invalid @enderror" id="qty" type="number" placeholder="Quantity" required name="qty" id="qty" max="10" min="1" step="1" value="{{ old('qty') }}">
                                                        <div id="qtyHelp" class="form-text">
                                                            Max 10 Tickets.
                                                          </div>
                                                        @error('qty')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                {{-- QTY --}}
                                                <div class="row align-items-end my-2 ">
                                                    <div class="col-md">
                                                        <label>Total Price :</label>
                                                        <input class="form-control" type="text" placeholder="Total Price" disabled id="total_price" value="{{(old('qty'))?old('qty')*100000:''}}">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer mt-3">
                                                <button type="submit" class="btn btn-primary">Buy</button>
                                            </div>
                                        </form>
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
    <script>
        $("#qty").keyup((e)=>{
            let qty = e.target.value;
            let price = 100000;
            let total_price = qty*price;
            $("#total_price").val(total_price);
        })
    </script>
    
@endsection

