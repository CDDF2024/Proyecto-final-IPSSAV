{{-- resources/views/facturas/factura.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>Factura #{{ $factura->id }}</title>
    <style>
        /* Estilos para el PDF */
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; }
        .details { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Factura #{{ $factura->id }}</h1>
        <p>Fecha: {{ $factura->fecha }}</p>
    </div>
    <div class="details">
        <h2>Detalles del cliente</h2>
        <p>Nombre: {{ $factura->cliente->nombre }}</p>
        <p>Documento: {{ $factura->cliente->documento }}</p>

        <h2>Detalles del Servicio</h2>
        <p>Servicio: {{ $factura->servicio->nombre }}</p>
        <p>Cantidad: {{ $factura->cantidad }}</p>
        <p>Total: {{ $factura->total }}</p>
        <p>Método de Pago: {{ $factura->metodo_pago }}</p>
        <p>Observaciones: {{ $factura->observaciones}}</p>
    </div>
</body>
</html>
