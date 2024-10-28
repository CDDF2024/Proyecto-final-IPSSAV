@extends('layouts.app')
@section('title')
    Crear Servicio
@endsection
@section('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        function campos(tipo) {
            if (tipo == 0) {
                document.getElementById('1').style.display = "none";
                document.getElementById('2').style.display = "none";
                document.getElementById('id_biologico').value = null; // Asigna null
                document.getElementById('id_muestra').value = null; // Asigna null
            }
            if (tipo == 'Biologicos') {
                document.getElementById('1').style.display = "block";
                document.getElementById('2').style.display = "none";
                document.getElementById('id_muestra').value = null; // Asigna null
            }
            if (tipo == 'Muestras') {
                document.getElementById('1').style.display = "none";
                document.getElementById('2').style.display = "block";
                document.getElementById('id_biologico').value = null; // Asigna null
            }
        }

        // Asignar la función a la selección
        document.getElementById('tipo').addEventListener('change', function() {
            campos(this.value);
        });

        
    });
</script>
@endsection
@section('content')
<div class="container">
    <h1 class="text-center mb-3">Agregar Servicio</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('servicios.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm" style="max-width: 700px; margin: auto;">
        @csrf
        <div class="mb-3">
            <label for="tipo" class="form-label">Seleccione el tipo de servicio</label>
            <select name="tipo" class="form-select" id="tipo">
                <option value="0" disabled selected>Seleccione el tipo de Servicio</option>
                <option value="Biologicos">Biologicos</option>
                <option value="Muestras">Muestras</option>
            </select>
        </div>
        
        <div id="1" class="mb-3" style="display: none;">
            <label for="nombre" class="form-label">Seleccione Biológico</label>
            <select name="nombre" class="form-select" id="nombre_biologico" onchange="document.getElementById('id_biologico').value = this.value;">
                <option value="" disabled selected>Seleccione un Biológico</option>
                @foreach($biologicos as $biologico)
                    <option value="{{ $biologico->id_biologico }}">{{ $biologico->nombre }}</option>
                @endforeach
            </select>
            <input type="hidden" name="id_biologico" id="id_biologico" value="">
        </div>

        <div id="2" class="mb-3" style="display: none;">
            <label for="nombre" class="form-label">Seleccione Muestra</label>
            <select name="nombre" class="form-select" id="nombre_muestra" onchange="document.getElementById('id_muestra').value = this.value;">
                <option value="" disabled selected>Seleccione una Muestra</option>
                @foreach($muestras as $muestra)
                    <option value="{{ $muestra->id }}">{{ $muestra->nombre }}</option>
                @endforeach
            </select>
            <input type="hidden" name="id_muestra" id="id_muestra" value="">
        </div>
        <div class="mb-3">
            <label for="detalles" class="form-label">Detalles</label>
            <textarea class="form-control" id="detalles" name="detalles"></textarea>
        </div>
        <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-success" style="width: 150px; white-space: nowrap;">Crear Servicio</button>
                <a href="{{ route('servicios.index') }}" class="btn btn-secondary" style="width: 100px; white-space: nowrap; margin-left: 10px;">Regresar</a>
        </div>
    </form>
</div>
@endsection