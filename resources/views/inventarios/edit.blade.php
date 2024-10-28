@extends('layouts.app')

@section('title')
    Editar Inventario
@stop

@section('content')
<div class="container">
    <h1 class="text-center my-4">Editar Inventario</h1>

    <form action="{{ route('inventarios.update', $inventario->id) }}" method="POST" class="bg-light p-4 rounded shadow-sm" style="max-width: 700px; margin: auto;">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="id_biologico" class="form-label">Biológico</label>
            <select class="form-select" name="id_biologico" required>
                <option value="">Seleccione un biológico</option>
                @foreach ($biologicos as $biologico)
                    <option value="{{ $biologico->id_biologico }}" {{ $biologico->id_biologico == $inventario->id_biologico ? 'selected' : '' }}>
                        {{ $biologico->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cantidad_disponible" class="form-label">Cantidad Disponible</label>
            <input type="number" class="form-control" name="cantidad_disponible" value="{{ $inventario->cantidad_disponible }}" required>
        </div>

        <div class="mb-3">
            <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
            <input type="date" class="form-control" name="fecha_vencimiento" value="{{ $inventario->fecha_vencimiento ? \Carbon\Carbon::parse($inventario->fecha_vencimiento)->format('Y-m-d') : '' }}">
        </div>

        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea class="form-control" name="observaciones" rows="3">{{ $inventario->observaciones }}</textarea>
        </div>

        <div class="mb-3">
            <label for="fecha_actualizacion" class="form-label">Fecha de Actualización</label>
            <input type="date" class="form-control" name="fecha_actualizacion" value="{{ $inventario->fecha_actualizacion ? \Carbon\Carbon::parse($inventario->fecha_actualizacion)->format('Y-m-d') : '' }}">
        </div>

        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-primary" style="width: 150px;">Actualizar</button>
            <a href="{{ route('inventarios.index') }}" class="btn btn-secondary ms-3" style="width: 150px;">Cancelar</a>
        </div>
    </form>
</div>
@endsection
