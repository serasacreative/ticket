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
                                <input type="text" id="barcodeInput" autofocus oninput="scanning(this.value)" style="height:200px;">
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
        $.ajax({
            url: "{{route('ticket.verify')}}",
            method: 'POST',
            data: { barcode: trimmedBarcode },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.valid)
                {
                    if(response.data.status == "paid"){
                        Swal.fire({
                            title: 'Success',
                            text: 'Jumlah Tiket : '+response.data.qty,
                            icon: 'success',
                        }).then(() => {
                            // After clicking 'OK', refocus on the barcode input field for automatic scanning
                            document.getElementById('barcodeInput').focus();
                        });
                    }else if(response.data.status = 'scanned')
                    {
                        Swal.fire({
                            title: 'Scanned',
                            text: 'Barcode has been scanned',
                            icon: 'warning',
                        }).then(() => {
                            // After clicking 'OK', refocus on the barcode input field for automatic scanning
                            document.getElementById('barcodeInput').focus();
                        });
                    }
                }else{
                    Swal.fire({
                            title: 'Error',
                            text: 'Barcode Not Valid !',
                            icon: 'error',
                        }).then(() => {
                            // After clicking 'OK', refocus on the barcode input field for automatic scanning
                            document.getElementById('barcodeInput').focus();
                        });
                }
                
                // Show SweetAlert with the response message
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

        // Clear the input field after processing
        document.getElementById('barcodeInput').value = '';
    }, 500); // Adjust the timeout duration as needed (e.g., 500ms, 1000ms, etc.)
}
</script>

@endsection

