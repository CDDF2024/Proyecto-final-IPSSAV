@extends('layouts.app')

@section('title')
    Editar Biológico
@endsection

@section('content')
<div class="container">
    <h1 class="text-center my-4">Editar Biológico</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('biologicos.update', $biologico->id_biologico) }}" method="POST" class="bg-light p-4 rounded shadow-sm" style="max-width: 700px; margin: auto;">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $biologico->nombre) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ old('cantidad', $biologico->cantidad) }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="{{ old('precio', $biologico->precio) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="presentacion" class="form-label">Presentación</label>
                <input type="text" class="form-control" id="presentacion" name="presentacion" value="{{ old('presentacion', $biologico->presentacion) }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" class="form-control" id="marca" name="marca" value="{{ old('marca', $biologico->marca) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="laboratorio" class="form-label">Laboratorio</label>
                <input type="text" class="form-control" id="laboratorio" name="laboratorio" value="{{ old('laboratorio', $biologico->laboratorio) }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="lote" class="form-label">Lote</label>
                <input type="text" class="form-control" id="lote" name="lote" value="{{ old('lote', $biologico->lote) }}" required>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-primary" style="width: 200px;">Actualizar Biológico</button>
            <a href="{{ route('biologicos.index') }}" class="btn btn-secondary ms-3" >Cancelar</a>
        </div>
    </form>
</div>
@endsection
