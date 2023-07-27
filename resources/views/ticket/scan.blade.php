@extends('layouts.app')

@section('css')
    
    <script src="{{ asset('quagga.min.js') }}"></script>
    
    <style>
        #barcode-scanner {
            width: 100%;
            height: 300px;
            border: 2px solid #ccc;
            margin: 20px auto;
            position: relative;
            overflow: hidden;
        }
    </style>
@endsection

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
                        <h1> Scan Ticket</h1>
                        <div class="row w-100 d-flex justify-content-evenly">
                            <div class="card py-4 text-center">
                                <div class="card-body">
                                    <div id="barcode-scanner"></div>
                                    <button type="button" class="btn btn-outline-primary" id="scan-button">Scan</button>
                                    <button type="button" class="btn btn-outline-primary" id="stop-button">Stop</button>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Flag to track if a successful scan has been processed
        let successfulScanProcessed = false;

        // Barcode scanning function
        function scanBarcode() {
            Quagga.init({
                // ... (rest of the QuaggaJS initialization code)
            }, function (err) {
                if (err) {
                    console.error("Error initializing Quagga:", err);
                    return;
                }
                Quagga.start();
            });

            Quagga.onProcessed(function (result) {
                if (result && result.codeResult && result.codeResult.code) {
                    // Barcode detected, stop scanning and process only once
                    if (!successfulScanProcessed) {
                        successfulScanProcessed = true; // Set the flag to true

                        const barcodeValue = result.codeResult.code;

                        // Send AJAX request to your Laravel backend
                        $.ajax({
                            url: "{{route('ticket.verify')}}",
                            type: "POST",
                            data: { barcode: barcodeValue },
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                            },
                            success: function (response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Ticket successfully scanned !',
                                    text: 'Quantity : '+response.qty,
                                });
                            },
                            error: function (xhr, status, error) {
                                console.error("Error sending AJAX request:", error);
                            },
                            complete: function () {
                                // Reset the flag after processing the scan
                                successfulScanProcessed = false;
                            }
                        });
                    }
                }
            });
        }

        // Attach the scanning function to the "Scan" button click event
        document.getElementById("scan-button").addEventListener("click", function () {
            scanBarcode();
        });
        document.getElementById("stop-button").addEventListener("click", function () {
            Quagga.stop();
            // Reset the flag when stopping the scanner manually
            successfulScanProcessed = false;
        });
    });
</script>

@endsection


