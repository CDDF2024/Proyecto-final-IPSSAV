@extends('layouts.app')

@section('title', 'Editar Factura')

@section('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        // Manejador para el cambio de tipo de servicio
        document.getElementById('tipo_servicio').addEventListener('change', function() {
            const tipo = this.value;
            const biologicosDiv = document.getElementById('biologicos');
            const muestrasDiv = document.getElementById('muestras');

            biologicosDiv.style.display = tipo === 'Biologicos' ? "block" : "none";
            muestrasDiv.style.display = tipo === 'Muestras' ? "block" : "none";
        });

        // Inicializar la visibilidad de los campos según el tipo de servicio
        const tipoServicio = document.getElementById('tipo_servicio').value;
        if (tipoServicio) {
            document.getElementById('biologicos').style.display = tipoServicio === 'Biologicos' ? "block" : "none";
            document.getElementById('muestras').style.display = tipoServicio === 'Muestras' ? "block" : "none";
        }
    });
</script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        // Manejador para calcular el total
        const cantidadInput = document.getElementById('cantidad');
        const precioInput = document.getElementById('precio');
        const totalInput = document.getElementById('total');

        function calcularTotal() {
            const cantidad = parseFloat(cantidadInput.value) || 0;
            const precio = parseFloat(precioInput.value) || 0;
            totalInput.value = (cantidad * precio).toFixed(2);
        }

        cantidadInput.addEventListener('input', calcularTotal);
        precioInput.addEventListener('input', calcularTotal);
    });
</script>
@endsection

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Editar Factura</h1>
    <form action="{{ route('facturas.update', $factura->id) }}" method="POST" class="bg-light p-4 rounded shadow-sm" style="max-width: 700px; margin: auto;">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="id_cliente">Cliente</label>
            <select name="id_cliente" class="form-control" required>
                <option value="">Selecciona un Cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $cliente->id == $factura->id_cliente ? 'selected' : '' }}>
                        {{ $cliente->nombre }} {{ $cliente->num_doc }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_usuario">Usuario</label>
            <select name="id_usuario" class="form-control" required>
                <option value="">Selecciona un usuario</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ $usuario->id == $factura->id_usuario ? 'selected' : '' }}>
                        {{ $usuario->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" class="form-control" value="{{ $factura->fecha }}" required>
        </div>
        <div class="form-group">
            <label for="tipo_servicio">Seleccione el tipo de servicio</label>
            <select name="tipo_servicio" class="form-control" id="tipo_servicio" required>
                <option value="" disabled>Seleccione el tipo de Servicio</option>
                <option value="Biologicos" {{ $factura->tipo_servicio == 'Biologicos' ? 'selected' : '' }}>Biologicos</option>
                <option value="Muestras" {{ $factura->tipo_servicio == 'Muestras' ? 'selected' : '' }}>Muestras</option>
            </select>
        </div>

        <div id="biologicos" class="form-group" style="display: {{ $factura->tipo_servicio == 'Biologicos' ? 'block' : 'none' }};">
            <label for="id_biologico">Seleccione Biológico</label>
            <select name="id_servicio" class="form-control" id="id_biologico">
                <option value="" disabled>Seleccione un Biológico</option>
                @foreach($servicios->where('tipo', 'Biologicos') as $servicio)
                    <option value="{{ $servicio->id }}" {{ $servicio->id == $factura->id_servicio ? 'selected' : '' }}>
                        {{ $servicio->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div id="muestras" class="form-group" style="display: {{ $factura->tipo_servicio == 'Muestras' ? 'block' : 'none' }};">
            <label for="id_muestra">Seleccione Muestra</label>
            <select name="id_servicio" class="form-control" id="id_muestra">
                <option value="" disabled>Seleccione una Muestra</option>
                @foreach($servicios->where('tipo', 'Muestras') as $servicio)
                    <option value="{{ $servicio->id }}" {{ $servicio->id == $factura->id_servicio ? 'selected' : '' }}>
                        {{ $servicio->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" id="cantidad" name="cantidad" class="form-control" value="{{ $factura->cantidad }}" required min="1">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ $factura->precio }}" required>
                </div>
            </div>
            <div class="col-md-4">    
                <div class="form-group">
                    <label for="total">Total</label>
                    <input type="number" id="total" name="total" class="form-control" value="{{ $factura->total }}" required readonly>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="metodo_pago">Método de Pago</label>
            <select name="metodo_pago" class="form-control" required>
                <option value="" disabled>Seleccione un método de pago</option>
                <option value="Efectivo" {{ $factura->metodo_pago == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                <option value="Tarjeta de Crédito" {{ $factura->metodo_pago == 'Tarjeta de Crédito' ? 'selected' : '' }}>Tarjeta de Crédito</option>
                <option value="Tarjeta de Débito" {{ $factura->metodo_pago == 'Tarjeta de Débito' ? 'selected' : '' }}>Tarjeta de Débito</option>
                <option value="Transferencia Bancaria" {{ $factura->metodo_pago == 'Transferencia Bancaria' ? 'selected' : '' }}>Transferencia Bancaria</option>
                <option value="Cheque" {{ $factura->metodo_pago == 'Cheque' ? 'selected' : '' }}>Cheque</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea class="form-control" name="observaciones" rows="3">{{ $factura->observaciones }}</textarea>
        </div>
        <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-success" style="width: 180px; white-space: nowrap;">Actualizar Factura</button>
                <a href="{{ route('facturas.index') }}" class="btn btn-secondary" style="width: 100px; white-space: nowrap; margin-left: 10px;">Regresar</a>
        </div>
    </form>
</div>
@endsection
