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
    let timeoutId; // Variable to store the timeout ID

// Function to handle the AJAX request
function scanning(barcode) {
    // Clear the previous timeout if it exists
    clearTimeout(timeoutId);

    // Set a new timeout to execute the scan after 500ms (adjust as needed)
    timeoutId = setTimeout(() => {
        // Get the input value after the timeout (complete barcode)
        const trimmedBarcode = barcode.trim();
        console.log(trimmedBarcode);

        // Make an AJAX request to the Laravel route using jQuery
        // ... (rest of the AJAX request code)

        // Clear the input field after processing
        document.getElementById('barcodeInput').value = '';
    }, 500); // Adjust the timeout duration as needed (e.g., 500ms, 1000ms, etc.)
}
</script>

@endsection

