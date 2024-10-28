@extends('layouts.app')

@section('title')
    Listado de Biológicos
@stop

@section('style')
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Lista de Biológicos</h1>
    <div class="table-func">
        <div class="input-group mb-3">
            <input type="text" id="buscar" placeholder="Buscar biológico..." class="search">
            <span class="input-group-text">
                <i class="fas fa-search"></i>
            </span>
        </div>
        <a href="{{ route('biologicos.create') }}" class="btn btn-success new">Añadir Biológico</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Presentación</th>
                    <th>Marca</th>
                    <th>Laboratorio</th>
                    <th>Lote</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($biologicos as $biologico)
                    <tr>
                        <td class="text-center">{{ $biologico->id_biologico }}</td>
                        <td>{{ $biologico->nombre }}</td>
                        <td>{{ $biologico->cantidad }}</td>
                        <td>{{ $biologico->precio }} COP</td>
                        <td>{{ $biologico->presentacion }}</td>
                        <td>{{ $biologico->marca }}</td>
                        <td>{{ $biologico->laboratorio }}</td>
                        <td>{{ $biologico->lote }}</td>
                        <div class="text-center">
                            <td>
                                <a href="{{ route('biologicos.edit', $biologico) }}" title="Editar">
                                    <i class="fas fa-edit text-success icon-hover" style="font-size: 20px;"></i>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-{{$biologico->id}}').submit();" title="Eliminar">
                                    <i class="fas fa-trash-alt text-danger icon-hover" style="font-size: 20px;"></i>
                                </a>
                                <form id="delete-{{$biologico->id}}" action="{{ route('biologicos.destroy', $biologico) }}" method="POST" style="display: none;">
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
                url: "{{ route('biologicos.buscar') }}",
                type: "GET",
                data: { query: query },
                success: function(data) {
                    // Limpiar la tabla
                    $('tbody').empty(); 

                    if (data.length) {
                        $.each(data, function(index, biologico) {
                            $('tbody').append('<tr>' +
                                '<td class="text-center">' + biologico.id_biologico + '</td>' +
                                '<td>' + biologico.nombre + '</td>' +
                                '<td>' + biologico.cantidad + '</td>' +
                                '<td>' + biologico.precio + ' COP</td>' +
                                '<td>' + biologico.presentacion + '</td>' +
                                '<td>' + biologico.marca + '</td>' +
                                '<td>' + biologico.laboratorio + '</td>' +
                                '<td>' + biologico.lote + '</td>' +
                                '<div class="text-center">' +
                                '<a href="{{ url("biologicos") }}/' + biologico.id_biologico + '/edit" title="Editar">' +
                                '<i class="fas fa-edit text-success icon-hover" style="font-size: 20px;"></i>' +
                                '</a>' +
                                '<a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById(\'delete-' + biologico.id_biologico + '\').submit();" title="Eliminar">' +
                                '<i class="fas fa-trash-alt text-danger icon-hover" style="font-size: 20px;"></i>' +
                                '</a>' +
                                '<form id="delete-' + biologico.id_biologico + '" action="{{ url("biologicos") }}/' + biologico.id_biologico + '" method="POST" style="display: none;">' +
                                '@csrf @method("DELETE")' +
                                '</form>' +
                                '</div>' +
                                '</tr>');
                        });
                    } else {
                        $('tbody').append('<tr><td colspan="10" class="text-center">No se encontraron biológicos.</td></tr>');
                    }
                }
            });
        });
    });
</script>
@endsection