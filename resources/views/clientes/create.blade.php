@extends('layouts.app')
@section('title')
    Agregar Clientes
@stop
@section('content')
<div class="container">
    <h1 class="text-center my-4">Agregar Cliente</h1>

    <form action="{{ route('clientes.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm" style="max-width: 700px; margin: auto;">
        @csrf
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>
            <div class="col-md-6">
                <label for="num_doc" class="form-label">Número de Documento</label>
                <input type="text" class="form-control" name="num_doc" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="correo_electronico" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" name="correo_electronico" required>
            </div>
            <div class="col-md-6">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" name="telefono">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" name="direccion">
            </div>
            <div class="col-md-6">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control" name="ciudad">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="departamento" class="form-label">Departamento</label>
                <input type="text" class="form-control" name="departamento">
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-success" style="width: 150px;">Crear Cliente</button>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary ms-3" style="width: 150px;">Cancelar</a>
        </div>
    </form>
</div>
@endsection
