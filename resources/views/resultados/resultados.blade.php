@extends('layouts.app')

@section('title')
    Resultados
@endsection
@section('content')

    <div class="container mt-5">
        <h1 class="text-center mb-2">Lista de Resultados</h1>

        @if ($resultados->isEmpty())
            <div class="alert alert-warning text-center" role="alert">
                No hay resultados disponibles.
            </div>
        @else
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Documento</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Muestra</th>
                        <th>Resultado</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resultados as $resultado)
                        <tr>
                            <td>{{ $resultado->pacientes->num_doc }}</td>
                            <td>{{ $resultado->pacientes->nombre}}</td>
                            <td>{{ $resultado->pacientes->apellido }}</td>
                            <td>{{ $resultado->muestras->tipo_muestra }}</td>
                            <td>{{ $resultado->resultado }}</td>
                            <td>{{ $resultado->fecha_resultado }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

@endsection
