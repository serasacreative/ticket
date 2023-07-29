<!DOCTYPE html>
<html>
<head>
    <title>Your Email Subject</title>

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <!-- Include the canvg library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/canvg/1.5/canvg.min.js"></script>
</head>
<body>
    <div style="text-align: center;">
        <img src="https://ticket.serasacreative.com/banner_mail.jpg" alt="Banner Image" style="max-width: 100%;">
    </div>
    
    Nama : {{$ticket->name}} 
    Kategori : {{$ticket->category}} 
    Jumlah Tiket : {{$ticket->qty}} 

    <!-- Add a canvas element to render the barcode -->
    <canvas id="barcodeCanvas"></canvas>

    <!-- Your other HTML content -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/plugin/barcodegen/JsBarcode.all.min.js') }}"></script>
    <script>
        $(function() {
            // Generate the barcode SVG
            var barcodeSvg = JsBarcode.getBarcodeSvg("{{$ticket->bar_code}}", {
                width: 1.5,
                height: 65,
                fontSize: 26,
                format: "CODE128",
                displayValue: true
            });

            // Convert the SVG to a PNG image using canvg
            var canvas = document.getElementById("barcodeCanvas");
            canvg(canvas, barcodeSvg);

            // Extract the image data from the canvas
            var imageData = canvas.toDataURL("image/png");

            // Create an <img> element with the barcode image data
            var barcodeImage = document.createElement("img");
            barcodeImage.src = imageData;

            // Append the image to the email body
            document.body.appendChild(barcodeImage);
        });
    </script>
</body>
</html>
