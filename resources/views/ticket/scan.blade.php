@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Your existing content here -->

        <div class="row clearfix">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Ticket Scanner</h6>
                    </div>
                    <div class="card-body">
                        <h1>Scanning</h1>
                        <div class="row w-100 d-flex justify-content-evenly">
                            <div class="card py-4 text-center"> 
                                <input type="text" id="barcodeInput" autofocus oninput="scanning(this.value)">
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
    $(document).ready(function() {
        // Function to handle the AJAX request
        function scanning(barcode) {
            // Make an AJAX request to the Laravel route using jQuery
            console.log(barcode)
            $.ajax({
                url: '/scan-barcode',
                method: 'POST',
                data: { barcode: barcode },
                success: function(response) {
                    // Show SweetAlert with the response message
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',
                    }).then(() => {
                        // After clicking 'OK', refocus on the barcode input field for automatic scanning
                        document.getElementById('barcodeInput').focus();
                    });
                },
                error: function(error) {
                    // Show SweetAlert with error message
                    Swal.fire({
                        title: 'Error',
                        text: 'Error processing barcode data',
                        icon: 'error',
                    });
                }
            });
        }

    });
</script>

@endsection

