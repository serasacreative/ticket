@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="hero-section">
            <img src="{{ asset('assets/hero-image.jpeg') }}" alt="Hero Image" class="img-fluid hero-image">
            <div class="hero-content">
                <h1>Welcome to Our Event</h1>
                <p>Join us for an unforgettable experience!</p>
                <!-- Add any additional content you want to display in the top section -->
            </div>
        </div>

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
                                            <li class="my-2"><i class="fa fa-calendar"></i> On 27 Aug 2023</li>
                                            <li class="my-2"><i class="fa fa-clock-o">15:00 - 24:00 WIB</i></li>
                                        </ul>
                                        <p class="fs-2">Rp 130.000</p>
                                        <a href="{{route('ticket.vip')}}" class="btn btn-outline-primary">Buy</a>
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
                                            <li class="my-2"><i class="fa fa-calendar"></i> On 27 Aug 2023</li>
                                            <li class="my-2"><i class="fa fa-clock-o">15:00 - 24:00 WIB</i></li>
                                        </ul>
                                        <p class="fs-2">Rp 100.000</p>
                                        <a href="{{route('ticket.festival')}}" class="btn btn-outline-primary">Buy</a>
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

