@extends('layouts.app')
@section('title')
    Editar Muestra
@stop
@section('content')
<div class="container">
    <h1 class="text-center mb-4">Editar Muestra</h1>

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

    <form action="{{ route('muestras.update', $muestra->id) }}" method="POST" class="bg-light p-4 rounded shadow-sm" style="max-width: 600px; margin: auto;">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="id_paciente">Paciente</label>
            <select name="id_paciente" id="id_paciente" class="form-control" required>
                <option value="">Selecciona un paciente</option>
                @foreach($pacientes as $paciente)
                    <option value="{{ $paciente->id_paciente }}" {{ $paciente->id_paciente == $muestra->id_paciente ? 'selected' : '' }}>
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
                    <option value="{{ $usuario->id }}" {{ $usuario->id == $muestra->id_profesional ? 'selected' : '' }}>
                        {{ $usuario->nombre }} {{ $usuario->apellido }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="aseguradora">Aseguradora</label>
            <input type="text" name="aseguradora" id="aseguradora" class="form-control" value="{{ old('aseguradora', $muestra->aseguradora) }}" required>
        </div>

        <div class="form-group">
            <label for="tipo_muestra">Tipo de Muestra</label>
            <input type="text" name="tipo_muestra" id="tipo_muestra" class="form-control" value="{{ old('tipo_muestra', $muestra->tipo_muestra) }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_resultado">Fecha de Resultado</label>
            <input type="date" name="fecha_resultado" id="fecha_resultado" class="form-control" value="{{ old('fecha_resultado', $muestra->fecha_resultado ? $muestra->fecha_resultado->format('Y-m-d') : '') }}" required>
        </div>

        <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-success" style="width: 180px; white-space: nowrap;">Actualizar Muestra</button>
                <a href="{{ route('muestras.index') }}" class="btn btn-secondary" style="width: 100px; white-space: nowrap; margin-left: 10px;">Regresar</a>
        </div>
    </form>
</div>
@endsection
