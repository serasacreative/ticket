<!DOCTYPE html>
<html>

<head>
    <title>Barcode Ticket</title>
    <style>
        @page {
            size: auto;
            margin: 0mm;
        }
        </style>
</head>

<body>
    total order = {{$ticket->qty}} 
    <svg id="barcode"></svg>
</body>

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
</html>
