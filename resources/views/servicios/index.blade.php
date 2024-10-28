@extends('layouts.app')

@section('title')
    Listado de Servicios
@stop

@section('style')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Lista de Servicios</h1>
    <div class="table-func">
        <div class="input-group mb-3">
            <input type="text" id="buscar" placeholder="Buscar servicio..." class="search">
            <span class="input-group-text">
                <i class="fas fa-search"></i>
            </span>
        </div>
        <a href="{{ route('servicios.create') }}" class="btn btn-success new">Añadir Servicio</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($servicios as $servicio)
                <tr>
                    <td class="text-center">{{ $servicio->id }}</td>
                    <td>{{ $servicio->tipo }}</td>
                    <td>
                        @if($servicio->biologico)
                            {{ $servicio->biologico->nombre }}
                        @elseif($servicio->muestra)
                            {{ $servicio->muestra->nombre }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $servicio->detalles }}</td>
                    <td class="text-center">
                        <a href="{{ route('servicios.edit', $servicio) }}" title="Editar">
                            <i class="fas fa-edit text-success icon-hover" style="font-size: 20px;"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-{{$servicio->id}}').submit();" title="Eliminar">
                            <i class="fas fa-trash-alt text-danger icon-hover" style="font-size: 20px;"></i>
                        </a>
                        <form id="delete-{{$servicio->id}}" action="{{ route('servicios.destroy', $servicio) }}" method="POST" style="display: none;">
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
                url: "{{ route('servicios.buscar') }}",
                type: "GET",
                data: { query: query },
                success: function(data) {
                    // Limpiar la tabla
                    $('tbody').empty(); 

                    if (data.length) {
                        $.each(data, function(index, servicio) {
                            $('tbody').append('<tr>' +
                                '<td class="text-center">' + servicio.id + '</td>' +
                                '<td>' + servicio.tipo + '</td>' +
                                '<td>' + (servicio.biologico ? servicio.biologico.nombre : (servicio.muestra ? servicio.muestra.nombre : 'N/A')) + '</td>' +
                                '<td>' + servicio.detalles + '</td>' +
                                '<td class="text-center">' +
                                '<a href="{{ url("servicios") }}/' + servicio.id + '/edit" title="Editar">' +
                                '<i class="fas fa-edit text-success icon-hover" style="font-size: 20px;"></i>' +
                                '</a>' +
                                '</td>' +
                                '<td class="text-center">' +
                                '<a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById(\'delete-' + servicio.id + '\').submit();" title="Eliminar">' +
                                '<i class="fas fa-trash-alt text-danger icon-hover" style="font-size: 20px;"></i>' +
                                '</a>' +
                                '<form id="delete-' + servicio.id + '" action="{{ url("servicios") }}/' + servicio.id + '" method="POST" style="display: none;">' +
                                '@csrf @method("DELETE")' +
                                '</form>' +
                                '</td>' +
                                '</tr>');
                        });
                    } else {
                        $('tbody').append('<tr><td colspan="6" class="text-center">No se encontraron servicios.</td></tr>');
                    }
                }
            });
        });
    });
</script>
@endsection