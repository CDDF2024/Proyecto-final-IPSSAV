@extends('layouts.app')
@section('title')
    Crear Rol
@stop
@section('content')
<div class="container">
    <h1 class="text-center mb-4">Crear Nuevo Rol</h1>
    <form action="{{ route('roles.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm" style="max-width: 500px; margin: auto;">
        @csrf
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="rol">Rol</label>
                    <input type="text" name="rol" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="4"></textarea>
        </div>
        <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-success" style="width: 150px; white-space: nowrap;">Crear Rol</button>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary" style="width: 100px; white-space: nowrap; margin-left: 10px;">Regresar</a>
        </div>
    </form>
</div>
@endsection
