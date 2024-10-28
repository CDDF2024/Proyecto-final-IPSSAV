@extends('layouts.app')
@section('title')
    Editar Servicio
@stop
@section('content')
<div class="container mb-4">
    <h1 class="text-center mb-3">Editar Servicio</h1>
    <form action="{{ route('servicios.update', $servicio->id) }}" method="POST" class="bg-light p-4 rounded shadow-sm" style="max-width: 700px; margin: auto;">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $servicio->nombre }}" required>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" class="form-control" id="tipo" name="tipo" value="{{ $servicio->tipo }}" required>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ $servicio->precio }}" required>
        </div>
        <div class="mb-3">
            <label for="detalles" class="form-label">Detalles</label>
            <textarea class="form-control" id="detalles" name="detalles">{{ $servicio->detalles }}</textarea>
        </div>
        <div class="mb-3">
            <label for="activo" class="form-label">Activo</label>
            <input type="checkbox" id="activo" name="activo" {{ $servicio->activo ? 'checked' : '' }}>
        </div>
        <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-success" style="width: 150px; white-space: nowrap;">Actualizar Servicio</button>
                <a href="{{ route('servicios.index') }}" class="btn btn-secondary" style="width: 100px; white-space: nowrap; margin-left: 10px;">Regresar</a>
        </div>
    </form>
</div>
@endsection