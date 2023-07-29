@extends('layouts.app')

@section('css')
<style>
    .hero-section {
        position: relative;
    }

    .hero-image {
        width: 100%;
        height: auto;
    }

    .hero-content h1 {
        font-size: 3rem;
        margin-bottom: 20px;
    }

    .hero-content p {
        font-size: 1.5rem;
        margin-bottom: 30px;
    }
</style>
    
@endsection

@section('content')
    <div class="hero-section">
        <img src="{{ asset('hero-image.jpeg') }}" alt="Hero Image" class="img-fluid hero-image">
    </div>
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row w-100 d-flex justify-content-evenly">
                            <div class="col-lg-4 col-md-5">
                                <div class="card py-4 text-center">
                                    <div class="card-body">
                                        <img class="img-fluid img-thumbnail w-50 mx-auto" src="{{asset('Logo-Mahafest.png')}}" alt="">
                                        <h2 class="pricing-header">
                                            @if($is_presale)
                                            <span class="text-info">PRE-SALE</span>
                                            @endif
                                             VIP</h2>
                                        <ul class="pricing-features list-unstyled">
                                            <li class="my-2">Free Merchandise</li>
                                            <li class="my-2"><i class="fa fa-calendar"></i> 27 Agustus 2023</li>
                                            <li class="my-2"><i class="fa fa-clock-o"> 15:00 - 24:00 WIB</i></li>
                                        </ul>
                                        <p class="fs-2">Rp 
                                            @if($is_presale)
                                            120.000 
                                            @else 
                                            130.000    
                                            @endif
                                        </p>
                                        <a href="{{route('ticket.vip')}}" class="btn btn-outline-primary">Beli</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-5">
                                <div class="card py-4 text-center">
                                    <div class="card-body">
                                        <img class="img-fluid img-thumbnail w-50 mx-auto" src="{{asset('Logo-Mahafest.png')}}" alt="">
                                        <h2 class="pricing-header">
                                            @if($is_presale)
                                            <span class="text-info">PRE-SALE</span>
                                            @endif
                                            Festival</h2>
                                        <ul class="pricing-features list-unstyled">
                                            <li class="my-2">Free Merchandise</li>
                                            <li class="my-2"><i class="fa fa-calendar"></i> 27 Agustus 2023</li>
                                            <li class="my-2"><i class="fa fa-clock-o"> 15:00 - 24:00 WIB</i></li>
                                        </ul>
                                        <p class="fs-2">Rp 
                                            @if($is_presale)
                                            95.000 
                                            @else 
                                            100.000 
                                            @endif   
                                        </p>
                                        <a href="{{route('ticket.festival')}}" class="btn btn-outline-primary">Beli</a>
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

