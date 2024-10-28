@extends('layouts.app')

@section('title')
    Editar Paciente
@stop

@section('content')
<div class="container">
    <h1 class="text-center mb-3">Editar Paciente</h1>
    <form action="{{ route('pacientes.update', $paciente->id_paciente) }}" method="POST" class="bg-light p-4 rounded shadow-sm" style="max-width: 700px; margin: auto;">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $paciente->nombre }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" name="apellido" class="form-control" value="{{ $paciente->apellido }}" required>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="tipo_doc" class="form-label">Tipo de Documento</label>
                    <select name="tipo_doc" class="form-control" required>
                        <option value="" disabled>Seleccione un tipo de documento</option>
                        <option value="CC" {{ $paciente->tipo_doc == 'CC' ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                        <option value="TI" {{ $paciente->tipo_doc == 'TI' ? 'selected' : '' }}>Tarjeta de Identidad</option>
                        <option value="CE" {{ $paciente->tipo_doc == 'CE' ? 'selected' : '' }}>Cédula de Extranjería</option>
                        <option value="PAS" {{ $paciente->tipo_doc == 'PAS' ? 'selected' : '' }}>Pasaporte</option>
                        <option value="RC" {{ $paciente->tipo_doc == 'RC' ? 'selected' : '' }}>Registro Civil</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="num_doc" class="form-label">Número de Documento</label>
                    <input type="text" name="num_doc" class="form-control" value="{{ $paciente->num_doc }}" required>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="genero" class="form-label">Género</label>
                    <input type="text" name="genero" class="form-control" value="{{ $paciente->genero }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="tipo_sangre" class="form-label">Tipo de Sangre</label>
                    <input type="text" name="tipo_sangre" class="form-control" value="{{ $paciente->tipo_sangre }}" required>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" class="form-control" value="{{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->format('Y-m-d') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fecha_expedicion_doc" class="form-label">Fecha de Expedición del Documento</label>
                    <input type="date" name="fecha_expedicion_doc" class="form-control" value="{{ \Carbon\Carbon::parse($paciente->fecha_expedicion_doc)->format('Y-m-d') }}" required>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ $paciente->telefono }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="correo_electronico" class="form-label">Correo Electrónico</label>
                    <input type="email" name="correo_electronico" class="form-control" value="{{ $paciente->correo_electronico }}" required>
                </div>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="alergias" class="form-label">Alergias</label>
            <input type="text" name="alergias" class="form-control" value="{{ $paciente->alergias }}" placeholder="Ingrese alergias si las tiene">
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            <button type="submit" class="btn btn-primary" style="width: 150px;">Actualizar</button>
            <a href="{{ route('pacientes.index') }}" class="btn btn-secondary ms-3" style="width: 150px;">Cancelar</a>
        </div>
    </form>
</div>
@stop
