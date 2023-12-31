@extends('layouts.app')


@section('content')
    <div class="container-fluid">

        <div class="block-header py-lg-4 py-3">
            <div class="row g-3">
                <div class="col-md-6 col-sm-12">
                    <h2 class="m-0 fs-5"><a href="{{route('ticket.index')}}" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Beranda</h2>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{route('ticket.index')}}">Beranda</a></li>
                        <li class="breadcrumb-item active">VIP Soldout</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-12">
                <div class="card" style="border-color: #007aff; border-width: 5px;">
                    <div class="card-header">
                        <h6 class="card-title">TIKET VIP</h6>
                    </div>
                    <div class="card-body">
                        <div class="row w-100 d-flex justify-content-evenly">
                            <div class="col-lg-4 col-md-12">
                                <div class="card py-4 text-center">
                                    <div class="card-body">
                                        <img class="img-fluid img-thumbnail w-50 mx-auto" src="{{asset('Logo-Mahafest.png')}}" alt="">
                                        <h2 class="pricing-header">VIP</h2>
                                        <ul class="pricing-features list-unstyled">
                                            <li class="my-2">Free Merchandise</li>
                                            <li class="my-2"><i class="fa fa-calendar"></i> 27 Agustus 2023</li>
                                            <li class="my-2"><i class="fa fa-clock-o"></i> 15:00 - 24:00 WIB</li>
                                            <li class="my-2"><i class="fa fa-map-marker"></i> GOR UNTUNG SUROPATI KOTA PASURUAN</li>
                                        </ul>

                                        <img src="{{asset('sold-out.png')}}" class="img-fluid" />
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
        $("#qty").change((e)=>{
            let qty = e.target.value;
            let price = 100000;
            let total_price = qty*price;
            $("#total_price").val(total_price);
        })
    </script>
    
@endsection

