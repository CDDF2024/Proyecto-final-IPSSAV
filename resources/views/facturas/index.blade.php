@extends('layouts.app')

@section('title')
    Listado de Facturas
@stop

@section('style')
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Lista de Facturas</h1>
    <div class="table-func">
        <div class="input-group mb-3">
            <input type="text" id="buscar" placeholder="Buscar factura..." class="search">
            <span class="input-group-text">
                <i class="fas fa-search"></i>
            </span>
        </div>
        <a href="{{ route('facturas.create') }}" class="btn btn-success new">Crear Nueva Factura</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Paciente</th>
                    <th>Usuario</th>
                    <th>Fecha</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Método de Pago</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    <th>Exportar PDF</th>
                </tr>
            </thead>
            <tbody>
                @foreach($facturas as $factura)
                    <tr>
                        <td class="text-center">{{ $factura->id }}</td>
                        <td>{{ $factura->cliente->nombre }}</td>
                        <td>{{ $factura->usuario->nombre }}</td>
                        <td>{{ $factura->fecha }}</td>
                        <td>{{ $factura->cantidad }}</td>
                        <td>{{ $factura->total }}</td>
                        <td>{{ $factura->metodo_pago }}</td>
                        <td class="text-center">
                            <a href="{{ route('facturas.edit', $factura->id) }}" title="Editar">
                                <i class="fas fa-edit text-success icon-hover" style="font-size: 20px;"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-{{$factura->id}}').submit();" title="Eliminar">
                                <i class="fas fa-trash-alt text-danger icon-hover" style="font-size: 20px;"></i>
                            </a>
                            <form id="delete-{{$factura->id}}" action="{{ route('facturas.destroy', $factura->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('factura.exportar', $factura->id) }}" title="Exportar PDF">
                                <i class="fas fa-file-pdf text-primary icon-hover" style="font-size: 20px;"></i>
                            </a>
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
                url: "{{ route('facturas.buscar') }}",
                type: "GET",
                data: { query: query },
                success: function(data) {
                    $('tbody').empty(); 

                    if (data.length) {
                        $.each(data, function(index, factura) {
                            $('tbody').append('<tr>' +
                                '<td class="text-center">' + factura.id + '</td>' +
                                '<td>' + factura.cliente.nombre + '</td>' +
                                '<td>' + factura.usuario.nombre + '</td>' +
                                '<td>' + factura.fecha + '</td>' +
                                '<td>' + factura.cantidad + '</td>' +
                                '<td>' + factura.total + '</td>' +
                                '<td>' + factura.metodo_pago + '</td>' +
                                '<td class="text-center">' +
                                '<a href="{{ url("facturas") }}/' + factura.id + '/edit" title="Editar">' +
                                '<i class="fas fa-edit text-success icon-hover" style="font-size: 20px;"></i>' +
                                '</a>' +
                                '</td>' +
                                '<td class="text-center">' +
                                '<a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById(\'delete-' + factura.id + '\').submit();" title="Eliminar">' +
                                '<i class="fas fa-trash-alt text-danger icon-hover" style="font-size: 20px;"></i>' +
                                '</a>' +
                                '<form id="delete-' + factura.id + '" action="{{ url("facturas") }}/' + factura.id + '" method="POST" style="display: none;">' +
                                '@csrf @method("DELETE")' +
                                '</form>' +
                                '</td>' +
                                '<td class="text-center">' +
                                '<a href="{{ url("factura.exportar") }}/' + factura.id + '" title="Exportar PDF">' +
                                '<i class="fas fa-file-pdf text-primary icon-hover" style="font-size: 20px;"></i>' +
                                '</a>' +
                                '</td>' +
                            '</tr>');
                        });
                    } else {
                        $('tbody').append('<tr><td colspan="10" class="text-center">No se encontraron facturas.</td></tr>');
                    }
                }
            });
        });
    });
</script>
@endsection
