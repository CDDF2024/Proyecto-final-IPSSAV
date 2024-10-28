@extends('layouts.app')

@section('title')
    Agregar Inventario
@stop

@section('content')
<div class="container">
    <h1 class="text-center my-4">Agregar Inventario</h1>

    <form action="{{ route('inventarios.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm" style="max-width: 700px; margin: auto;">
        @csrf
        
        <div class="mb-3">
            <label for="id_biologico" class="form-label">Biológico</label>
            <select class="form-select" name="id_biologico" id="id_biologico" required>
                <option value="">Seleccione un biológico</option>
                @foreach ($biologicos as $biologico)
                    <option value="{{ $biologico->id_biologico }}" data-cantidad="{{ $biologico->cantidad }}">{{ $biologico->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cantidad_disponible" class="form-label">Cantidad Disponible</label>
            <input type="number" class="form-control" name="cantidad_disponible" id="cantidad_disponible" required>
        </div>

        <div class="mb-3">
            <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
            <input type="date" class="form-control" name="fecha_vencimiento">
        </div>

        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea class="form-control" name="observaciones" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="fecha_actualizacion" class="form-label">Fecha de Actualizacion</label>
            <input type="date" class="form-control" name="fecha_actualizacion">
        </div>

        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-primary" style="width: 150px;">Guardar</button>
            <a href="{{ route('inventarios.index') }}" class="btn btn-secondary ms-3" style="width: 150px;">Cancelar</a>
        </div>
    </form>
</div>

@section('scripts')
<script>
    document.getElementById('id_biologico').addEventListener('change', function() {
        var cantidad = this.options[this.selectedIndex].dataset.cantidad;
        document.getElementById('cantidad_disponible').value = cantidad;
    });
</script>
@endsection
@endsection
