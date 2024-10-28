@extends('layouts.app')

@section('title')
    Listado Clientes
@stop

@section('style')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Clientes</h1>
    <div class="table-func">
        <div class="input-group mb-3">
            <input type="text" id="buscar" placeholder="Buscar cliente..." class="search">
            <span class="input-group-text">
                <i class="fas fa-search"></i>
            </span>
        </div>
        <a href="{{ route('clientes.create') }}" class="btn btn-success new">Agregar Cliente</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Número de Documento</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->num_doc }}</td>
                        <td>{{ $cliente->correo_electronico }}</td>
                        <td>{{ $cliente->telefono }}</td>
                        <td class="text-center">
                            <a href="{{ route('clientes.edit', $cliente) }}" title="Editar">
                            <i class="fa-solid fa-file-pen text-success icon-hover" style="font-size: 20px;"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-{{$cliente->id}}').submit();" title="Eliminar">
                                <i class="fas fa-trash-alt text-danger icon-hover" style="font-size: 20px;"></i>
                            </a>
                            <form id="delete-{{$cliente->id}}" action="{{ route('clientes.destroy', $cliente) }}" method="POST" style="display: none;">
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
                url: "{{ route('clientes.buscar') }}",
                type: "GET",
                data: { query: query },
                success: function(data) {
                    // Limpiar la tabla
                    $('tbody').empty(); 

                    if (data.length) {
                        $.each(data, function(index, cliente) {
                            $('tbody').append('<tr>' +
                                '<td>' + cliente.nombre + '</td>' +
                                '<td>' + cliente.num_doc + '</td>' +
                                '<td>' + cliente.correo_electronico + '</td>' +
                                '<td>' + cliente.telefono + '</td>' +
                                '<td class="text-center">' +
                                '<a href="{{ url("clientes") }}/' + cliente.id + '/edit" title="Editar">' +
                                '<i class="fa-solid fa-file-pen text-success icon-hover" style="font-size: 20px;"></i>' +
                                '</a>' +
                                '</td>' +
                                '<td class="text-center">' +
                                '<a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById(\'delete-' + cliente.id + '\').submit();" title="Eliminar">' +
                                '<i class="fas fa-trash-alt text-danger icon-hover" style="font-size: 20px;"></i>' +
                                '</a>' +
                                '<form id="delete-' + cliente.id + '" action="{{ url("clientes") }}/' + cliente.id + '" method="POST" style="display: none;">' +
                                '@csrf @method("DELETE")' +
                                '</form>' +
                                '</td>' +
                                '</tr>');
                        });
                    } else {
                        $('tbody').append('<tr><td colspan="6" class="text-center">No se encontraron clientes.</td></tr>');
                    }
                }
            });
        });
    });
</script>
@endsection