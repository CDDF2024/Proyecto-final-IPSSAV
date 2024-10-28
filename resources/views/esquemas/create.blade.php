@extends('layouts.app')
@section('title')
    Agregar Esquema Vacunacion
@stop
@section('content')
<div class="container">
    <h1 class="text-center my-4">Crear Esquema</h1>

    <form action="{{ route('esquemas.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm" style="max-width: 700px; margin: auto;">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="id_paciente" class="form-label">Paciente</label>
                <select name="id_paciente" id="id_paciente" class="form-control" required>
                    <option value="">Seleccione un paciente</option>
                    @foreach($pacientes as $paciente)
                        <option value="{{ $paciente->id_paciente }}">{{ $paciente->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="id_biologico" class="form-label">Biológico</label>
                <select name="id_biologico" id="id_biologico" class="form-control" required>
                    <option value="">Seleccione un biológico</option>
                    @foreach($biologicos as $biologico)
                        <option value="{{ $biologico->id_biologico }}">{{ $biologico->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="dosis_administrada" class="form-label">Dosis Administrada</label>
                <input type="number" name="dosis_administrada" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="fecha_administracion" class="form-label">Fecha de Administración</label>
                <input type="date" name="fecha_administracion" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="edad_paciente" class="form-label">Edad del Paciente</label>
                <input type="number" name="edad_paciente" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label for="lugar_aplicacion" class="form-label">Lugar de Aplicación</label>
                <input type="text" name="lugar_aplicacion" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="id_usuario" class="form-label">Usuario</label>
                <select name="id_usuario" id="id_usuario" class="form-control" required>
                    <option value="">Seleccione un usuario</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <label for="efectos_secundarios" class="form-label">Efectos Secundarios</label>
                <textarea name="efectos_secundarios" class="form-control"></textarea>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-success" style="width: 200px;">Crear Esquema</button>
            <a href="{{ route('esquemas.index') }}" class="btn btn-secondary" style="width: 100px; white-space: nowrap; margin-left: 10px;">Regresar</a>
        </div>
    </form>
</div>
@endsection
