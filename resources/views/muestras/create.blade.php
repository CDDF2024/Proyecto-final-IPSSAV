@extends('layouts.app')
@section('title')
    Crear Muestra
@stop
@section('content')
<div class="container">
    <h1 class="text-center mb-4">Crear Nueva Muestra</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('muestras.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm" style="max-width: 600px; margin: auto;">
        @csrf

        <div class="form-group">
            <label for="id_paciente">Paciente</label>
            <select name="id_paciente" id="id_paciente" class="form-control" required>
                <option value="">Selecciona un paciente</option>
                @foreach($pacientes as $paciente)
                    <option value="{{ $paciente->id_paciente }}">
                        {{ $paciente->nombre }} {{ $paciente->apellido }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="id_profesional">Profesional</label>
            <select name="id_profesional" id="id_profesional" class="form-control" required>
                <option value="">Selecciona un profesional</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">
                        {{ $usuario->nombre }} {{ $usuario->apellido }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="aseguradora">Aseguradora</label>
            <input type="text" name="aseguradora" id="aseguradora" class="form-control" value="{{ old('aseguradora') }}" required>
        </div>

        <div class="form-group">
            <label for="tipo_muestra">Tipo de Muestra</label>
            <input type="text" name="tipo_muestra" id="tipo_muestra" class="form-control" value="{{ old('tipo_muestra') }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_resultado">Fecha de Resultado</label>
            <input type="date" name="fecha_resultado" id="fecha_resultado" class="form-control" value="{{ old('fecha_resultado') }}" required>
        </div>

        <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-success" style="width: 150px; white-space: nowrap;">Crear Muestra</button>
                <a href="{{ route('muestras.index') }}" class="btn btn-secondary" style="width: 100px; white-space: nowrap; margin-left: 10px;">Regresar</a>
        </div>
    </form>
</div>
@endsection
