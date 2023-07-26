@extends('layouts.app')


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
                        <h1> Ticket </h1>

                        <form method="POST" action="{{route('ticket.checkout')}}">
                            @csrf
                            <div class="modal-body">
                                {{-- Email --}}
                                <div class="row align-items-end my-2 ">
                                    <div class="col-md">
                                        <label>Email :</label>
                                        <input class="form-control" type="email" placeholder="Email" required name="email">
                                    </div>
                                </div>
                                {{-- QTY --}}
                                <div class="row align-items-end my-2 ">
                                    <div class="col-md">
                                        <label>Jumlah tiket :</label>
                                        <input class="form-control" type="number" placeholder="Jumlah Tiker" required name="qty">
                                    </div>
                                </div>
                                {{-- QTY --}}
                                <div class="row align-items-end my-2 ">
                                    <div class="col-md">
                                        <label>Harga satuan :</label>
                                        <input class="form-control" type="number" placeholder="Harga Satuan" required name="price">
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer mt-3">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

