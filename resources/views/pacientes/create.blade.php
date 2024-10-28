@extends('layouts.app')

@section('title')
    Agregar Paciente
@stop

@section('content')
<div class="container">
    <h1 class="text-center mb-3">Agregar Paciente</h1>
    <form action="{{ route('pacientes.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm" style="max-width: 700px; margin: auto;">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Ingrese su nombre" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" name="apellido" class="form-control" placeholder="Ingrese su apellido" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="tipo_doc" class="form-label">Tipo de Documento</label>
                    <select name="tipo_doc" class="form-control" required>
                        <option value="" disabled selected>Seleccione un tipo de documento</option>
                        <option value="CC">Cédula de Ciudadanía</option>
                        <option value="TI">Tarjeta de Identidad</option>
                        <option value="CE">Cédula de Extranjería</option>
                        <option value="PAS">Pasaporte</option>
                        <option value="RC">Registro Civil</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="num_doc" class="form-label">Número de Documento</label>
                    <input type="text" name="num_doc" class="form-control" placeholder="Ingrese el número de documento" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="genero" class="form-label">Género</label>
                    <input type="text" name="genero" class="form-control" placeholder="Ingrese su género" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="tipo_sangre" class="form-label">Tipo de Sangre</label>
                    <input type="text" name="tipo_sangre" class="form-control" placeholder="Ingrese su tipo de sangre" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fecha_expedicion_doc" class="form-label">Fecha de Expedición del Documento</label>
                    <input type="date" name="fecha_expedicion_doc" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" placeholder="Ingrese su teléfono" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="correo_electronico" class="form-label">Correo Electrónico</label>
                    <input type="email" name="correo_electronico" class="form-control" placeholder="Ingrese su correo electrónico" required>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="alergias" class="form-label">Alergias</label>
            <input type="text" name="alergias" class="form-control" placeholder="Ingrese alergias si las tiene">
        </div>
        <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-success" style="width: 150px; white-space: nowrap;">Crear Paciente</button>
                <a href="{{ route('pacientes.index') }}" class="btn btn-secondary" style="width: 100px; white-space: nowrap; margin-left: 10px;">Regresar</a>
        </div>
    </form>
</div>
@stop
