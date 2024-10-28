@extends('layouts.app')

@section('title')
    Listado de Esquemas
@stop

@section('style')
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Esquemas</h1>
    <div class="table-func">
        <div class="input-group mb-3">
            <input type="text" id="buscar" placeholder="Buscar esquema..." class="search">
            <span class="input-group-text">
                <i class="fas fa-search"></i>
            </span>
        </div>
        <a href="{{ route('esquemas.create') }}" class="btn btn-success new">Crear Esquema</a>
    </div>

    @if(session('msn'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('msn') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Paciente</th>
                    <th>Biológico</th>
                    <th>Dosis Administrada</th>
                    <th>Fecha de Administración</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($esquemas as $esquema)
                <tr>
                    <td class="text-center">{{ $esquema->id }}</td>
                    <td>{{ $esquema->paciente->nombre }}</td>
                    <td>{{ $esquema->biologico->nombre }}</td>
                    <td>{{ $esquema->dosis_administrada }}</td>
                    <td>{{ $esquema->fecha_administracion }}</td>
                    <td class="text-center">
                        <a href="{{ route('esquemas.edit', $esquema->id) }}" title="Editar">
                            <i class="fas fa-edit text-success icon-hover" style="font-size: 20px;"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-{{$esquema->id}}').submit();" title="Eliminar">
                            <i class="fas fa-trash-alt text-danger icon-hover" style="font-size: 20px;"></i>
                        </a>
                        <form id="delete-{{$esquema->id}}" action="{{ route('esquemas.destroy', $esquema->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#buscar').on('keyup', function() {
            let query = $(this).val();

            $.ajax({
                url: "{{ route('esquemas.buscar') }}",
                type: "GET",
                data: { query: query },
                success: function(data) {
                    // Limpiar la tabla
                    $('tbody').empty(); 

                    if (data.length) {
                        $.each(data, function(index, esquema) {
                            $('tbody').append('<tr>' +
                                '<td class="text-center">' + esquema.id + '</td>' +
                                '<td>' + esquema.paciente.nombre + '</td>' +
                                '<td>' + esquema.biologico.nombre + '</td>' +
                                '<td>' + esquema.dosis_administrada + '</td>' +
                                '<td>' + esquema.fecha_administracion + '</td>' +
                                '<td class="text-center">' +
                                '<a href="{{ url("esquemas") }}/' + esquema.id + '/edit" title="Editar">' +
                                '<i class="fas fa-edit text-success icon-hover" style="font-size: 20px;"></i>' +
                                '</a>' +
                                '</td>' +
                                '<td class="text-center">' +
                                '<a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById(\'delete-' + esquema.id + '\').submit();" title="Eliminar">' +
                                '<i class="fas fa-trash-alt text-danger icon-hover" style="font-size: 20px;"></i>' +
                                '</a>' +
                                '<form id="delete-' + esquema.id + '" action="{{ url("esquemas") }}/' + esquema.id + '" method="POST" style="display: none;">' +
                                '@csrf @method("DELETE")' +
                                '</form>' +
                                '</td>' +
                                '</tr>');
                        });
                    } else {
                        $('tbody').append('<tr><td colspan="7" class="text-center">No se encontraron esquemas</td></tr>');
                    }
                }
            });
        });
    });
</script>
@endsection