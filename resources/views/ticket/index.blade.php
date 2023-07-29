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

    .hero-content {
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        transform: translateY(-50%);
        text-align: center;
        color: #fff;
        padding: 30px; /* Adjust the padding as needed */
        background-color: rgba(0, 0, 0, 0.6); /* Add a semi-transparent background */
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
        <img src="{{ asset('assets/hero-image.jpeg') }}" alt="Hero Image" class="img-fluid hero-image">
        <div class="hero-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 text-center">
                        <h1>Welcome to Our Event</h1>
                        <p>Join us for an unforgettable experience!</p>
                        <!-- Add any additional content you want to display in the top section -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row w-100 d-flex justify-content-evenly">
                            <div class="col-lg-4 col-md-12">
                                <div class="card py-4 text-center">
                                    <div class="card-body">
                                        <img src="{{asset('assets/images/paper-plane.png')}}" alt="" class="pricing-img">
                                        <h2 class="pricing-header">VIP</h2>
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
                            <div class="col-lg-4 col-md-12">
                                <div class="card py-4 text-center">
                                    <div class="card-body">
                                        <img src="{{asset('assets/images/paper-plane.png')}}" alt="" class="pricing-img">
                                        <h2 class="pricing-header">Festival</h2>
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

