@extends('layouts.app')

@section('title')
    Listado Inventario
@stop

@section('style')
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Inventarios</h1>
    <div class="table-func">
        <div class="input-group mb-3">
            <input type="text" id="buscar" placeholder="Buscar inventario..." class="search">
            <span class="input-group-text">
                <i class="fas fa-search"></i>
            </span>
        </div>
        <a href="{{ route('inventarios.create') }}" class="btn btn-success new">Agregar Inventario</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Biológico</th>
                    <th>Cantidad Disponible</th>
                    <th>Fecha de Vencimiento</th>
                    <th>Observaciones</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventarios as $inventario)
                    <tr>
                        <td class="text-center">{{ $inventario->id }}</td>
                        <td>{{ $inventario->biologico->nombre }}</td>
                        <td>{{ $inventario->cantidad_disponible }}</td>
                        <td>{{ $inventario->fecha_vencimiento }}</td>
                        <td>{{ $inventario->observaciones }}</td>
                        <div class="text-center">
                            <td>
                            <a href="{{ route('inventarios.edit', $inventario->id) }}" title="Editar">
                                <i class="fa-solid fa-file-pen text-success icon-hover" style="font-size: 20px;"></i>
                            </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-{{$inventario->id}}').submit();" title="Eliminar">
                                    <i class="fas fa-trash-alt text-danger icon-hover" style="font-size: 20px;"></i>
                                </a>
                                <form id="delete-{{$inventario->id}}" action="{{ route('inventarios.destroy', $inventario->id) }}" method="POST" style="display: none;">
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
                url: "{{ route('inventarios.buscar') }}",
                type: "GET",
                data: { query: query },
                success: function(data) {
                    // Limpiar la tabla
                    $('tbody').empty(); 

                    if (data.length) {
                        $.each(data, function(index, inventario) {
                            $('tbody').append('<tr>' +
                                '<td class="text-center">' + inventario.id + '</td>' +
                                '<td>' + inventario.biologico.nombre + '</td>' +
                                '<td>' + inventario.cantidad_disponible + '</td>' +
                                '<td>' + inventario.fecha_vencimiento + '</td>' +
                                '<td>' + inventario.observaciones + '</td>' +
                                '<div class="text-center">' +
                                '<td>' +
                                '<a href="{{ url("inventarios") }}/' + inventario.id + '/edit" title="Editar">' +
                                '<i class="fa-solid fa-file-pen text-success icon-hover" style="font-size: 20px;"></i>' +
                                '</a>' +
                                '</td>' +
                                '<td>' +
                                '<a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById(\'delete-' + inventario.id + '\').submit();" title="Eliminar">' +
                                '<i class="fas fa-trash-alt text-danger icon-hover" style="font-size: 20px;"></i>' +
                                '</a>' +
                                '<form id="delete-' + inventario.id + '" action="{{ url("inventarios") }}/' + inventario.id + '" method="POST" style="display: none;">' +
                                '@csrf @method("DELETE")' +
                                '</form>' +
                                '</td>' +
                                '</div>' +
                                '</tr>');
                        });
                    } else {
                        $('tbody').append('<tr><td colspan="7" class="text-center">No se encontraron inventarios.</td></tr>');
                    }
                }
            });
        });
    });
</script>
@endsection