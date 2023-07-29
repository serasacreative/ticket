@extends('layouts.app')

@section('css')
    <script src="{{ asset('quagga.min.js') }}"></script>
    <style>
        #barcode-scanner {
            width: 100%;
            height: 300px;
            border: 2px solid #ccc;
            margin: 0;
            position: relative;
            overflow: hidden;
        }
    </style>
@endsection

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
                        <h1>Scanning</h1>0
                        <div class="row w-100 d-flex justify-content-evenly">
                            <div class="card py-4 text-center"> 
                                <input type="text" id="barcodeInput" autofocus>
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
        function sendBarcodeData(barcode) {
            // Make an AJAX request to the Laravel route using jQuery
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

        // Event listener for the barcode input field
        $('#barcodeInput').on('input', function(event) {
            // Get the barcode input value
            const barcode = event.target.value;

            // Assuming the scanner appends a newline character at the end of the scan
            if (barcode.endsWith('\n')) {
                // Remove the newline character
                const trimmedBarcode = barcode.trim();

                // Call the function to handle the barcode data
                sendBarcodeData(trimmedBarcode);

                // Clear the input field after processing
                event.target.value = '';
            }
        });
    });
</script>

@endsection

