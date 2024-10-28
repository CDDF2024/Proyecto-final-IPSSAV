@extends('layouts.app')

@section('title')
    Listado de roles
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Roles</h1>
    <div class="table-func">
        <div class="input-group mb-3">
            <input type="text" id="buscar" placeholder="Buscar rol..." class="search">
            <span class="input-group-text">
                <i class="fas fa-search"></i>
            </span>
        </div>
        <a href="{{ route('roles.create') }}" class="btn btn-success new">Crear Rol</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Rol</th>
                    <th>Descripción</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $rol)
                <tr>
                    <td>{{ $rol->id_rol }}</td>
                    <td>{{ $rol->rol }}</td>
                    <td>{{ $rol->descripcion }}</td>
                    <td class="text-center">
                        <a href="{{ route('roles.edit', $rol->id_rol) }}" title="Editar">
                            <i class="fa-solid fa-file-pen text-success icon-hover" style="font-size: 20px;"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-{{$rol->id_rol}}').submit();" title="Eliminar">
                            <i class="fas fa-trash-alt text-danger icon-hover" style="font-size: 20px;"></i>
                        </a>
                        <form id="delete-{{$rol->id_rol}}" action="{{ route('roles.destroy', $rol->id_rol) }}" method="POST" style="display: none;">
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
                url: "{{ route('roles.buscarRoles') }}",
                type: "GET",
                data: { query: query },
                success: function(data) {
                    // Limpiar la tabla
                    $('tbody').empty(); 

                    if (data.length) {
                        $.each(data, function(index, rol) {
                            $('tbody').append('<tr>' +
                                '<td>' + rol.id_rol + '</td>' +
                                '<td>' + rol.rol + '</td>' +
                                '<td>' + rol.descripcion + '</td>' +
                                '<td class="text-center">' +
                                '<a href="{{ url("roles") }}/' + rol.id_rol + '/edit" title="Editar">' +
                                '<i class="fa-solid fa-file-pen text-success icon-hover" style="font-size: 20px;"></i>' +
                                '</a>' +
                                '</td>' +
                                '<td class="text-center">' +
                                '<a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById(\'delete-' + rol.id_rol + '\').submit();" title="Eliminar">' +
                                '<i class="fas fa-trash-alt text-danger icon-hover" style="font-size: 20px;"></i>' +
                                '</a>' +
                                '<form id="delete-' + rol.id_rol + '" action="{{ url("roles") }}/' + rol.id_rol + '" method="POST" style="display: none;">' +
                                '@csrf @method("DELETE")' +
                                '</form>' +
                                '</td>' +
                                '</tr>');
                        });
                    } else {
                        $('tbody').append('<tr><td colspan="5" class="text-center">No se encontraron roles.</td></tr>');
                    }
                }
            });
        });
    });
</script>
@endsection
