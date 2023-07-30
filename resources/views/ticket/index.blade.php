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
    
    <div class="container-fluid">
        <div class="hero-section">
            <img src="{{ asset('hero-image.jpeg') }}" alt="Hero Image" class="img-fluid hero-image">
        </div>
        <div class="row clearfix">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row w-100 d-flex justify-content-evenly">
                            <div class="col-lg-4 col-md-5 mb-3">
                                <div class="card py-4 text-center" style="border-color: #007aff; border-width: 5px;">
                                    <div class="card-body">
                                        <img class="img-fluid img-thumbnail w-50 mx-auto" src="{{asset('Logo-Mahafest.png')}}" alt="">
                                        <h2 class="pricing-header" style="color:#007aff">
                                            @if($is_presale)
                                            <span class="text-info h5">PRE-SALE</span>
                                            @endif
                                             VIP</h2>
                                        <ul class="pricing-features list-unstyled">
                                            <li class="my-2">Free Merchandise</li>
                                            <li class="my-2"><i class="fa fa-calendar"></i> 27 Agustus 2023</li>
                                            <li class="my-2"><i class="fa fa-clock-o"></i> 15:00 - 24:00 WIB</li>
                                            <li class="my-2"><i class="fas fa-map-marker-alt"></i> GOR UNTUNG SUROPATI KOTA PASURUAN</li>
                                        </ul>
                                        @if($is_presale)
                                        <p class="fs-1"><del>Rp 150.000</del></p>
                                        @endif
                                        <p class="fs-2">Rp 
                                            @if($is_presale)
                                            130.000 
                                            @else 
                                            150.000    
                                            @endif
                                        </p>
                                        <a href="{{route('ticket.vip')}}" class="btn btn-outline-primary">Beli</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-5 ">
                                <div class="card py-4 text-center border border-5 border-success">
                                    <div class="card-body">
                                        <img class="img-fluid img-thumbnail w-50 mx-auto" src="{{asset('Logo-Mahafest.png')}}" alt="">
                                        <h2 class="pricing-header text-success">
                                            @if($is_presale)
                                            <span class="text-info h5">PRE-SALE</span>
                                            @endif
                                            Festival</h2>
                                        <ul class="pricing-features list-unstyled">
                                            <li class="my-2">Free Merchandise</li>
                                            <li class="my-2"><i class="fa fa-calendar"></i> 27 Agustus 2023</li>
                                            <li class="my-2"><i class="fa fa-clock-o"></i> 15:00 - 24:00 WIB</li>
                                            <li class="my-2"><i class="fas fa-map-marker-alt"></i> GOR UNTUNG SUROPATI KOTA PASURUAN</li>
                                        </ul>

                                        @if($is_presale)
                                        <p class="fs-1"><del>Rp 110.000</del></p>
                                        @endif
                                        <p class="fs-2">Rp 
                                            @if($is_presale)
                                            100.000 
                                            @else 
                                            110.000 
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

