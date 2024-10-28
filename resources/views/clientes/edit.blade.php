@extends('layouts.app')
@section('title')
    Editar Clientes
@stop
@section('content')
<div class="container">
    <h1 class="text-center my-4">Editar Cliente</h1>

    <form action="{{ route('clientes.update', $cliente) }}" method="POST" class="bg-light p-4 rounded shadow-sm" style="max-width: 700px; margin: auto;">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{ $cliente->nombre }}" required>
            </div>
            <div class="col-md-6">
                <label for="num_doc" class="form-label">Número de Documento</label>
                <input type="text" class="form-control" name="num_doc" value="{{ $cliente->num_doc }}" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="correo_electronico" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" name="correo_electronico" value="{{ $cliente->correo_electronico }}" required>
            </div>
            <div class="col-md-6">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" name="telefono" value="{{ $cliente->telefono }}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" name="direccion" value="{{ $cliente->direccion }}">
            </div>
            <div class="col-md-6">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control" name="ciudad" value="{{ $cliente->ciudad }}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="departamento" class="form-label">Departamento</label>
                <input type="text" class="form-control" name="departamento" value="{{ $cliente->departamento }}">
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-success" style="width: 180px; white-space: nowrap;">Actualizar Cliente</button>
                <a href="{{ route('clientes.index') }}" class="btn btn-secondary" style="width: 100px; white-space: nowrap; margin-left: 10px;">Regresar</a>
        </div>
    </form>
</div>
@endsection
