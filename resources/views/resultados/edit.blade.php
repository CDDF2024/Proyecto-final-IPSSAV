@extends('layouts.app')

@section('title')
    Editar Resultado
@stop

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Editar Resultado</h1>

    @if(session('msn'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('msn') }}
        </div>
    @endif

    <form action="{{ route('resultados.update', $resultado->id) }}" method="POST" class="bg-light p-4 rounded shadow-sm" style="max-width: 600px; margin: auto;">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="id_paciente">Selecciona un Paciente</label>
            <select name="id_paciente" id="id_paciente" class="form-control" required>
                <option value="">Seleccione un paciente</option>
                @foreach ($pacientes as $paciente)
                    <option value="{{ $paciente->id_paciente }}" {{ $paciente->id_paciente == $resultado->id_paciente ? 'selected' : '' }}>
                        {{ $paciente->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="id_muestra">Selecciona una Muestra</label>
            <select name="id_muestra" id="id_muestra" class="form-control" required>
                <option value="">Seleccione una muestra</option>
                @foreach ($pacientes as $paciente)
                    <optgroup label="{{ $paciente->nombre }}">
                        @foreach ($paciente->muestras as $muestra)
                            <option value="{{ $muestra->id }}" {{ $muestra->id == $resultado->id_muestra ? 'selected' : '' }}>
                                {{ $muestra->tipo_muestra }}
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="resultado">Resultado</label>
            <textarea name="resultado" id="resultado" class="form-control" required>{{ old('resultado', $resultado->resultado) }}</textarea>
        </div>

        <div class="form-group">
            <label for="fecha_resultado">Fecha del Resultado</label>
            <input type="date" name="fecha_resultado" id="fecha_resultado" class="form-control" value="{{ old('fecha_resultado', \Carbon\Carbon::parse($resultado->fecha_resultado)->format('Y-m-d')) }}" required>
        </div>

        <div class="form-group">
            <label for="interpretacion">Interpretación (opcional)</label>
            <textarea name="interpretacion" id="interpretacion" class="form-control">{{ old('interpretacion', $resultado->interpretacion) }}</textarea>
        </div>

        <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-success" style="width: 180px; white-space: nowrap;">Actualizar Resultado</button>
                <a href="{{ route('resultados.index') }}" class="btn btn-secondary" style="width: 100px; white-space: nowrap; margin-left: 10px;">Regresar</a>
        </div>
    </form>
</div>
@endsection
