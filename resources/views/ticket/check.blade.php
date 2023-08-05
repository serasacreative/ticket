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
                        <div class="row">
                            <div class="col-12">

                                <input type="text" id="inputField" placeholder="Enter your data">
                                <button id="submitBtn">Submit</button>
                            </div>
                            <div class="col-12">

                            <div class="table-responsive">

                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h6 class="card-title">Basic Example 1</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>order id</th>
                                        <th>order status</th>
                                        <th>email</th>
                                        <th>email status</th>
                                        <th>category</th>
                                        <th>qty</th>
                                        <th>total price</th>
                                    </tr>
                                </thead>
                                <tbody id="orders-table">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('js')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Set the CSRF token header for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Handle the AJAX request when the button is clicked
        $('#submitBtn').on('click', function () {
            var inputData = $('#inputField').val();

            $.ajax({
                type: 'POST',
                url: '{{ route("ticket.checkdata") }}',
                data: { data: inputData },
                success: function (response) {
                    console.log(response)
                    if (Array.isArray(response.data)) {
                        var tableBody = '';
                        response.data.forEach(function (item) {
                            var emailStatus = '';
                            if(item.status === 'paid'){
                                var emailStatus = item.email_data.status;
                            }
                            var email = item.email;
                            var orderId = item.id;
                            var orderStatus = item.status;
                            var orderCategory = item.category;
                            var orderQty = item.qty;
                            var orderTotalPrice = item.total_price;

                            tableBody += '<tr>';
                            tableBody += '<td>' + orderId + '</td>';
                            tableBody += '<td>' + orderStatus + '</td>';
                            tableBody += '<td>' + email + '</td>';
                            tableBody += '<td>' + emailStatus + '</td>';
                            tableBody += '<td>' + orderCategory + '</td>';
                            tableBody += '<td>' + orderQty + '</td>';
                            tableBody += '<td>' + orderTotalPrice + '</td>';
                            tableBody += '</tr>';
                        });

                        // Assuming your table has an ID "orders-table" and a tbody with ID "table-body"
                        $('#orders-table').html(tableBody);
                    } 
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    $('#result').html('<p>Error occurred. Please try again later.</p>');
                }
            });
        });
    });
</script>
@endsection

