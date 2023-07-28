@extends('layouts.app')


@section('content')
    <div class="container-fluid">

        <div class="block-header py-lg-4 py-3">
            <div class="row g-3">
                <div class="col-md-6 col-sm-12">
                    <h2 class="m-0 fs-5"><a href="{{route('ticket.index')}}" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Tickets</h2>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{route('ticket.index')}}">Ticket</a></li>
                        <li class="breadcrumb-item active"><a href="{{Crypt::encrypt('AdminDashboard')}}">Ticket</a> </li>
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
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>ticket_pending</th>
                                                    <th>ticket_paid</th>
                                                    <th>ticket_paid_total</th>
                                                    <th>ticket_scanned</th>
                                                    <th>ticket_scanned_total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>{{$ticket_pending}}</td>
                                                    <td>{{$ticket_paid}}</td>
                                                    <td>{{$ticket_paid_total}}</td>
                                                    <td>{{$ticked_scanned}}</td>
                                                    <td>{{$ticket_scanned_total}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
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

