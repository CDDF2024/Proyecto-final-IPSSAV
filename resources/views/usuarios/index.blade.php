@extends('layouts.app')
@section('title')
    Listado Usuarios
@stop
@section('style')
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Lista de Usuarios</h1>
    <div class="table-func">
        <div class="input-group mb-3">
            <input type="text" id="buscar" placeholder="Buscar usuario..." class="search">
            <span class="input-group-text">
                <i class="fas fa-search"></i>
            </span>
        </div>
        <a href="{{ route('usuarios.create') }}" class="btn btn-success new">Crear Usuario</a>
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
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td class="text-center">{{ $usuario->id }}</td>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->apellido }}</td>
                        <td>{{ $usuario->tipo_doc }}</td>
                        <td>{{ $usuario->num_doc }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->rol->rol }}</td>
                        <div class="text-center">
                            <td>
                            <a href="{{ route('usuarios.edit', $usuario->id) }}" title="Editar">
                                <i class="fa-solid fa-file-pen text-success icon-hover" style="font-size: 20px;"></i>
                            </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-{{$usuario->id}}').submit();" title="Eliminar">
                                    <i class="fas fa-trash-alt text-danger icon-hover" style="font-size: 20px;"></i>
                                </a>
                                <form id="delete-{{$usuario->id}}" action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display: none;">
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
                url: "{{ route('usuarios.buscar') }}",
                type: "GET",
                data: { query: query },
                success: function(data) {
                    // Limpiar la tabla
                    $('tbody').empty(); 

                    if (data.length) {
                        $.each(data, function(index, usuario) {
                            $('tbody').append('<tr>' +
                                '<td class="text-center">' + usuario.id + '</td>' +
                                '<td>' + usuario.nombre + '</td>' +
                                '<td>' + usuario.apellido + '</td>' +
                                '<td>' + usuario.tipo_doc + '</td>' +
                                '<td>' + usuario.num_doc + '</td>' +
                                '<td>' + usuario.email + '</td>' +
                                '<td>' + usuario.rol.rol + '</td>' +
                                '<div class="text-center">' +
                                '<a href="{{ url("usuarios") }}/' + usuario.id + '/edit" title="Editar">' +
                                '<i class="fa-solid fa-file-pen text-success icon-hover" style="font-size: 20px;"></i>' +
                                '</a>' +
                                '<a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById(\'delete-' + usuario.id + '\').submit();" title="Eliminar">' +
                                '<i class="fas fa-trash-alt text-danger icon-hover" style="font-size: 20px;"></i>' +
                                '</a>' +
                                '<form id="delete-' + usuario.id + '" action="{{ url("usuarios") }}/' + usuario.id + '" method="POST" style="display: none;">' +
                                '@csrf @method("DELETE")' +
                                '</form>' +
                                '</div>' +
                                '</tr>');
                        });
                    } else {
                        $('tbody').append('<tr><td colspan="8" class="text-center">No se encontraron usuarios.</td></tr>');
                    }
                }
            });
        });
    });
</script>
@endsection
