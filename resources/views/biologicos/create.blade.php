@extends('layouts.app')
@section('title')
    Agregar Biologico
@stop
@section('content')
<div class="container">
    <h1 class="text-center my-4">Crear Biológico</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('biologicos.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm" style="max-width: 700px; margin: auto;">
        @csrf
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" placeholder="Ingrese el precio" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="presentacion" class="form-label">Presentación</label>
                <input type="text" class="form-control" id="presentacion" name="presentacion" placeholder="Ingrese la presentación" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" class="form-control" id="marca" name="marca" placeholder="Ingrese la marca" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="laboratorio" class="form-label">Laboratorio</label>
                <input type="text" class="form-control" id="laboratorio" name="laboratorio" placeholder="Ingrese el laboratorio" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="lote" class="form-label">Lote</label>
                <input type="text" class="form-control" id="lote" name="lote" placeholder="Ingrese el lote" required>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-primary" style="width: 150px;">Crear Biológico</button>
            <a href="{{ route('biologicos.index') }}" class="btn btn-secondary ms-3" style="width: 150px;">Cancelar</a>
        </div>
    </form>
</div>
@endsection
