<!DOCTYPE html>
<html>
<head>
    <title>Your Email Subject</title>
</head>
<body>
    <div style="text-align: center;">
    <img src="https://ticket.serasacreative.com/banner_mail.jpg" alt="Banner Image" style="max-width: 100%;">
        
    total order = {{$ticket->qty}} 
    <svg id="barcode"></svg>
    </div>
    


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/plugin/barcodegen/JsBarcode.all.min.js') }}"></script>
    <script>
        $(function() {
            // $("#barcode").JsBarcode("{{$ticket->bar_code}}", {
            $("#barcode").JsBarcode("{{$ticket->bar_code}}", {
                width: 1.5,
                height: 65,
                fontSize: 26,
                format: "code128",
                displayValue: true
            });
        })
    </script>
</body>
</html>
