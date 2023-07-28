@extends('layouts.app')


@section('content')
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Order Your Ticket</h6>
                    </div>
                    <div class="card-body">
                        <h1> Ticket List</h1>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ticket_pending</th>
                                            <th>ticket_paid</th>
                                            <th>ticket_paid_total_price</th>
                                            <th>ticket_scanned</th>
                                            <th>ticket_scanned_total_price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>{{$ticket_pending}}</td>
                                            <td>{{$ticket_paid}}</td>
                                            <td>{{$ticket_paid_total}}</td>
                                            <td>{{$ticket_scanned}}</td>
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

@endsection

