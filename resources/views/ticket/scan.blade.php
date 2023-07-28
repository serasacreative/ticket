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
                        <h6 class="card-title">Order Your Ticket</h6>
                    </div>
                    <div class="card-body">
                        <h1>Scan Ticket</h1>0
                        <div class="row w-100 d-flex justify-content-evenly">
                            <div class="card py-4 text-center">
                                <div class="w-100">
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
            let scannerRunning = false;

            function scanBarcode() {
                if (!scannerRunning) {
                    scannerRunning = true;
                    Quagga.init({
                        inputStream: {
                            name: "Live",
                            type: "LiveStream",
                            target: document.querySelector("#barcode-scanner"),
                            constraints: {
                                facingMode: "environment" // Use the rear camera for mobile devices
                            },
                        },
                        decoder: {
                            readers: ["code_128_reader"], // Specify the barcode format to scan (e.g., CODE128)
                            debug: {
                                drawBoundingBox: true,
                                showFrequency: true,
                                drawScanline: true,
                                showPattern: true,
                            },
                        },
                    }, function (err) {
                        if (err) {
                            console.error("Error initializing Quagga:", err);
                            scannerRunning = false;
                            return;
                        }
                        Quagga.start();
                    });

                    Quagga.onDetected(function (result) {
                        if (scannerRunning) {
                            scannerRunning = false;
                            if (result && result.codeResult && result.codeResult.code) {
                                const barcodeValue = result.codeResult.code;

                                $.ajax({
                                    url: "{{ route('ticket.verify') }}",
                                    type: "POST",
                                    data: { barcode: barcodeValue },
                                    headers: {
                                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                                    },
                                    success: function (response) {
                                        console.log(response)
                                        if (response.valid) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Ticket successfully scanned!',
                                                text: 'Quantity: ' + response.data.qty,
                                            });
                                        } else {
                                            // Handle the case when the barcode is not valid
                                            // For example, show an error message
                                            console.log("Invalid barcode");
                                            // Do not stop Quagga, let it continue scanning
                                        }
                                        scannerRunning = true;
                                    },
                                    error: function (xhr, status, error) {
                                        console.error("Error sending AJAX request:", error);
                                    },
                                });
                            }
                        }
                    });
                }
            }

            document.getElementById("scan-button").addEventListener("click", function () {
                scanBarcode();
            });

            document.getElementById("stop-button").addEventListener("click", function () {
                    Quagga.stop();
                    scannerRunning = false;
                
            });
        });
    </script>
@endsection

