@extends('layouts.app')


@section('content')
    <div class="container-fluid">

        <div class="block-header py-lg-4 py-3">
            <div class="row g-3">
                <div class="col-md-6 col-sm-12">
                    <h2 class="m-0 fs-5"><a href="{{route('ticket.index')}}" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Beranda</h2>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{route('ticket.index')}}">Beranda</a></li>
                        <li class="breadcrumb-item active">Tiket VIP</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">TIKET VIP</h6>
                    </div>
                    <div class="card-body">
                        <div class="row w-100 d-flex justify-content-evenly">
                            <div class="col-lg-3 col-md-12 mb-3">
                                <div class="card py-4 text-center" style="border-color: #007aff; border-width: 5px;">
                                    <div class="card-body">
                                        <img class="img-fluid img-thumbnail w-50 mx-auto" src="{{asset('Logo-Mahafest.png')}}" alt="">
                                        <h2 class="pricing-header">VIP</h2>
                                        <ul class="pricing-features list-unstyled">
                                            <li class="my-2">Free Merchandise</li>
                                            <li class="my-2"><i class="fa fa-calendar"></i> On 27 Agustus 2023</li>
                                            <li class="my-2"><i class="fa fa-clock-o"> 15:00 - 24:00 WIB</i></li>
                                        </ul>

                                        @if($is_presale)
                                        <p class="fs-1"><del>Rp 130.000</del></p>
                                        @endif
                                        <p class="fs-2">Rp 
                                            @if($is_presale)
                                            120.000 
                                            @else 
                                            130.000 
                                            @endif
                                           </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-12">
                                <div class="card py-4 text-center" style="border-color: #007aff; border-width: 5px;">
                                    <div class="card-body">
                                        @if (session('error'))
                                        <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                            
                                        <img class="img-fluid img-thumbnail w-50 mx-auto" src="{{asset('Logo-Mahafest.png')}}" alt="">
                                        <h2 class="pricing-header"> Lengkapi data anda !</h2>

                                        <form method="POST" action="{{route('ticket.checkout.vip')}}">
                                            @csrf
                                            <div class="modal-body">
                                                {{-- Email --}}
                                                <div class="row align-items-end my-2 ">
                                                    <div class="col-md">
                                                        <label>Email :</label>
                                                        <input class="form-control @error('email') is-invalid @enderror" type="email" placeholder="Email" required name="email" value="{{ old('email') }}">
                                                        <div id="emailHelp" class="form-text">
                                                            Tiket akan dikirim ke email ada !
                                                          </div>
                                                        @error('email')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                {{-- Name --}}
                                                <div class="row align-items-end my-2 ">
                                                    <div class="col-md">
                                                        <label>Nama :</label>
                                                        <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Name" required name="name" value="{{ old('name') }}">
                                                        @error('name')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                {{-- Phone --}}
                                                <div class="row align-items-end my-2 ">
                                                    <div class="col-md">
                                                        <label>No HP :</label>
                                                        <input class="form-control @error('phone') is-invalid @enderror" type="number" placeholder="No HP" required name="phone" value="{{ old('phone') }}">
                                                        @error('phone')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                {{-- QTY --}}
                                                <div class="row align-items-end my-2 ">
                                                    <div class="col-md">
                                                        <label>Jumlah Tiket :</label>
                                                        <input class="form-control @error('qty') is-invalid @enderror" id="qty" type="number" placeholder="Jumlah Tiket" required name="qty" id="qty" max="10" min="1" step="1" value="{{ old('qty') }}">
                                                        <div id="qtyHelp" class="form-text">
                                                            Maks 10 Tiket.
                                                          </div>
                                                        @error('qty')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                {{-- QTY --}}
                                                <div class="row align-items-end my-2 ">
                                                    <div class="col-md">
                                                        <label>Harga Total :</label>
                                                        <input class="form-control" type="text" placeholder="Harga Total" disabled id="total_price" value="{{(old('qty'))?old('qty')*130000:''}}">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer mt-3">
                                                <button type="submit" class="btn btn-primary">Beli</button>
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
        const price = {{$price}};
        $("#qty").keyup((e)=>{
            let qty = e.target.value;
            let total_price = qty*price;
            $("#total_price").val(total_price);
        })
    </script>
    
@endsection

