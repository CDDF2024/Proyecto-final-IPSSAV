@extends('layouts.app')

@section('title')
    Listado Resultados
@stop

@section('style')
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Lista de Resultados</h1>
    <div class="table-func">
        <div class="input-group mb-3">
            <input type="text" id="buscar" placeholder="Buscar resultado..." class="search">
            <span class="input-group-text">
                <i class="fas fa-search"></i>
            </span>
        </div>
        <a href="{{ route('resultados.create') }}" class="btn btn-success new">Agregar Nuevo Resultado</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Paciente</th>
                    <th>Muestra</th>
                    <th>Resultado</th>
                    <th>Fecha del Resultado</th>
                    <th>Interpretación</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datos as $resultado)
                    <tr>
                        <td class="text-center">{{ $resultado->id }}</td>
                        <td>{{ $resultado->pacientes->nombre }}</td>
                        <td>{{ $resultado->muestras->tipo_muestra }}</td>
                        <td>{{ $resultado->resultado }}</td>
                        <td>{{ $resultado->fecha_resultado }}</td>
                        <td>{{ $resultado->interpretacion }}</td>
                        <div class="text-center">
                            <td>
                                <a href="{{ route('resultados.edit', $resultado->id) }}" title="Editar">
                                    <i class="fas fa-edit text-success icon-hover" style="font-size: 20px;"></i>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-{{$resultado->id}}').submit();" title="Eliminar">
                                    <i class="fas fa-trash-alt text-danger icon-hover" style="font-size: 20px;"></i>
                                </a>
                                <form id="delete-{{$resultado->id}}" action="{{ route('resultados.destroy', $resultado->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </div>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if (session('type'))
        <div id="alert-message" class="alert alert-{{ session('type') }} alert-dismissible fade show alerta" role="alert">
            <strong>Mensaje:</strong> {{ session('msn') }}
        </div>
    @endif
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#buscar').on('keyup', function() {
            let query = $(this).val();

            $.ajax({
                url: "{{ route('resultados.buscar') }}",
                type: "GET",
                data: { query: query },
                success: function(data) {
                    // Limpiar la tabla
                    $('tbody').empty();

                    if (data.length) {
                        $.each(data, function(index, resultado) {
                            $('tbody').append('<tr>' +
                                '<td class="text-center">' + resultado.id + '</td>' +
                                '<td>' + resultado.pacientes.nombre + '</td>' +
                                '<td>' + resultado.muestras.tipo_muestra + '</td>' +
                                '<td>' + resultado.resultado + '</td>' +
                                '<td>' + resultado.fecha_resultado + '</td>' +
                                '<td>' + resultado.interpretacion + '</td>' +
                                '<div class="text-center">' +
                                '<a href="{{ url("resultados") }}/' + resultado.id + '/edit" title="Editar">' +
                                '<i class="fas fa-edit text-success icon-hover" style="font-size: 20px;"></i>' +
                                '</a>' +
                                '<a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById(\'delete-' + resultado.id + '\').submit();" title="Eliminar">' +
                                '<i class="fas fa-trash-alt text-danger icon-hover" style="font-size: 20px;"></i>' +
                                '</a>' +
                                '<form id="delete-' + resultado.id + '" action="{{ url("resultados") }}/' + resultado.id + '" method="POST" style="display: none;">' +
                                '@csrf @method("DELETE")' +
                                '</form>' +
                                '</div>' +
                                '</tr>');
                        });
                    } else {
                        $('tbody').append('<tr><td colspan="8" class="text-center">No se encontraron resultados.</td></tr>');
                    }
                }
            });
        });
    });
</script>
@endsection