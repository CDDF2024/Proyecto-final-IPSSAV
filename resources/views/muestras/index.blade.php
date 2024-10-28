@extends('layouts.app')
@section('title')
    Listado de Muestras
@stop
@section('style')
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Muestras</h1>
    <div class="table-func">
        <div class="input-group mb-3">
            <input type="text" id="buscar" placeholder="Buscar muestra..." class="search">
            <span class="input-group-text">
                <i class="fas fa-search"></i>
            </span>
        </div>
        <a href="{{ route('muestras.create') }}" class="btn btn-success new">Agregar Muestra</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Tipo de Documento</th>
                    <th>Número de Documento</th>
                    <th>Género</th>
                    <th>Tipo Sanguíneo</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Fecha de Expedición</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                    <th>Tipo de Muestra</th>
                    <th>Aseguradora</th>
                    <th>Fecha de Resultado</th>
                    <th>Profesional</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($muestras as $muestra)
                    <tr>
                        <td class="text-center">{{ $muestra->id }}</td>
                        <td>{{ $muestra->paciente->nombre }}</td>
                        <td>{{ $muestra->paciente->apellido }}</td>
                        <td>{{ $muestra->paciente->tipo_doc }}</td>
                        <td>{{ $muestra->paciente->num_doc }}</td>
                        <td>{{ $muestra->paciente->genero }}</td>
                        <td>{{ $muestra->paciente->tipo_sangre }}</td>
                        <td>{{ $muestra->paciente->fecha_nacimiento }}</td>
                        <td>{{ $muestra->paciente->fecha_expedicion_doc }}</td>
                        <td>{{ $muestra->paciente->telefono }}</td>
                        <td>{{ $muestra->paciente->correo_electronico }}</td>
                        <td>{{ $muestra->tipo_muestra }}</td>
                        <td>{{ $muestra->aseguradora }}</td>
                        <td>{{ $muestra->fecha_resultado }}</td>
                        <td>{{ $muestra->usuario->nombre }} {{ $muestra->usuario->apellido }}</td>
                        <td class="text-center">
                            <a href="{{ route('muestras.edit', $muestra->id) }}" title="Editar">
                                <i class="fa-solid fa-file-pen text-success icon-hover" style="font-size: 20px;"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-{{$muestra->id}}').submit();" title="Eliminar">
                                <i class="fas fa-trash-alt text-danger icon-hover" style="font-size: 20px;"></i>
                            </a>
                            <form id="delete-{{$muestra->id}}" action="{{ route('muestras.destroy', $muestra->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
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
                url: "{{ route('muestras.buscar') }}",
                type: "GET",
                data: { query: query },
                success: function(data) {
                    // Limpiar la tabla
                    $('tbody').empty(); 

                    if (data.length) {
                        $.each(data, function(index, muestra) {
                            $('tbody').append('<tr>' +
                                '<td class="text-center">' + muestra.id + '</td>' +
                                '<td>' + muestra.paciente.nombre + '</td>' +
                                '<td>' + muestra.paciente.apellido + '</td>' +
                                '<td>' + muestra.paciente.tipo_doc + '</td>' +
                                '<td>' + muestra.paciente.num_doc + '</td>' +
                                '<td>' + muestra.paciente.genero + '</td>' +
                                '<td>' + muestra.paciente.tipo_sangre + '</td>' +
                                '<td>' + muestra.paciente.fecha_nacimiento + '</td>' +
                                '<td>' + muestra.paciente.fecha_expedicion_doc + '</td>' +
                                '<td>' + muestra.paciente.telefono + '</td>' +
                                '<td>' + muestra.paciente.correo_electronico + '</td>' +
                                '<td>' + muestra.tipo_muestra + '</td>' +
                                '<td>' + muestra.aseguradora + '</td>' +
                                '<td>' + muestra.fecha_resultado + '</td>' +
                                '<td>' + muestra.usuario.nombre + ' ' + muestra.usuario.apellido + '</td>' +
                                '<td class="text-center">' +
                                '<a href="{{ url("muestras") }}/' + muestra.id + '/edit" title="Editar">' +
                                '<i class="fa-solid fa-file-pen text-success icon-hover" style="font-size: 20px;"></i>' +
                                '</a>' +
                                '</td>' +
                                '<td class="text-center">' +
                                '<a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById(\'delete-' + muestra.id + '\').submit();" title="Eliminar">' +
                                '<i class="fas fa-trash-alt text-danger icon-hover" style="font-size: 20px;"></i>' +
                                '</a>' +
                                '<form id="delete-' + muestra.id + '" action="{{ url("muestras") }}/' + muestra.id + '" method="POST" style="display: none;">' +
                                '@csrf @method("DELETE")' +
                                '</form>' +
                                '</td>' +
                            '</tr>');
                        });
                    }else {
                        $('tbody').append('<tr><td colspan="6" class="text-center">No se encontraron clientes.</td></tr>');
                    }
                }
            });
        });
    });
</script>
@endsection