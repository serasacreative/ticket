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

