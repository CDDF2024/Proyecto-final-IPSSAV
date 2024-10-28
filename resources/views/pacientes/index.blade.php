@extends('layouts.app')

@section('title')
    Listado Pacientes
@stop

@section('style')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Pacientes</h1>
    <div class="table-func">
        <div class="input-group mb-3">
            <input type="text" id="buscar" placeholder="Buscar paciente..." class="search">
            <span class="input-group-text">
                <i class="fas fa-search"></i>
            </span>
        </div>
        <a href="{{ route('pacientes.create') }}" class="btn btn-success new">Agregar Paciente</a>
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
                    <th>Tipo sanguíneo</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pacientes as $paciente)
                    <tr>
                        <td class="text-center">{{ $paciente->id_paciente }}</td>
                        <td>{{ $paciente->nombre }}</td>
                        <td>{{ $paciente->apellido }}</td>
                        <td>{{ $paciente->tipo_doc }}</td>
                        <td>{{ $paciente->num_doc }}</td>
                        <td>{{ $paciente->genero }}</td>
                        <td>{{ $paciente->tipo_sangre }}</td>
                        <td>{{ $paciente->fecha_nacimiento }}</td>
                        <td>{{ $paciente->telefono }}</td>
                        <td>{{ $paciente->correo_electronico }}</td>
                        <td class="text-center">
                            <a href="{{ route('pacientes.edit', $paciente->id_paciente) }}" title="Editar">
                                <i class="fa-solid fa-file-pen text-success icon-hover" style="font-size: 20px;"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-{{$paciente->id_paciente}}').submit();" title="Eliminar">
                                <i class="fas fa-trash-alt text-danger icon-hover" style="font-size: 20px;"></i>
                            </a>
                            <form id="delete-{{$paciente->id_paciente}}" action="{{ route('pacientes.destroy', $paciente->id_paciente) }}" method="POST" style="display: none;">
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
            url: "{{ route('pacientes.buscar') }}",
            type: "GET",
            dataType: "json",
            data: { query: query },
            success: function(data) {
                $('tbody').empty();

                if (data.length) {
                    $.each(data, function(index, paciente) {
                        $('tbody').append('<tr>' +
                            '<td class="text-center">' + paciente.id_paciente + '</td>' +
                            '<td>' + paciente.nombre + '</td>' +
                            '<td>' + paciente.apellido + '</td>' +
                            '<td>' + paciente.tipo_doc + '</td>' +
                            '<td>' + paciente.num_doc + '</td>' +
                            '<td>' + paciente.genero + '</td>' +
                            '<td>' + paciente.tipo_sangre + '</td>' +
                            '<td>' + paciente.fecha_nacimiento + '</td>' +
                            '<td>' + paciente.telefono + '</td>' +
                            '<td>' + paciente.correo_electronico + '</td>' +
                            '<td class="text-center">' +
                            '<a href="{{ url("pacientes") }}/' + paciente.id_paciente + '/edit" title="Editar">' +
                            '<i class="fa-solid fa-file-pen text-success icon-hover" style="font-size: 20px;"></i>' +
                            '</a>' +
                            '</td>' +
                            '<td class="text-center">' +
                            '<a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById(\'delete-' + paciente.id_paciente + '\').submit();" title="Eliminar">' +
                            '<i class="fas fa-trash-alt text-danger icon-hover" style="font-size: 20px;"></i>' +
                            '</a>' +
                            '<form id="delete-' + paciente.id_paciente + '" action="{{ url("pacientes") }}/' + paciente.id_paciente + '" method="POST" style="display: none;">' +
                            '@csrf @method("DELETE")' +
                            '</form>' +
                            '</td>' +
                            '</tr>');
                    });
                } else {
                    $('tbody').append('<tr><td colspan="12" class="text-center">No se encontraron pacientes.</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud AJAX:', error);
            }
        });
    });
});
</script>
@endsection
