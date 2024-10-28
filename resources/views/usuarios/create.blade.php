@extends('layouts.app')

@section('title')
    Crear Usuario
@stop

@section('content')
    <div class="container">
        <h1 class="text-center mb-3">Crear Usuario</h1>
        <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow-sm" style="max-width: 700px; margin: auto;">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Ingrese su nombre" required>
                    @error('nombre')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" name="apellido" class="form-control" placeholder="Ingrese su apellido" required>
                    @error('apellido')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tipo_doc" class="form-label">Tipo de Documento</label>
                    <select name="tipo_doc" class="form-control" required>
                        <option value="" disabled selected>Seleccione un tipo de documento</option>
                        <option value="CC">Cédula de Ciudadanía</option>
                        <option value="TI">Tarjeta de Identidad</option>
                        <option value="CE">Cédula de Extranjería</option>
                        <option value="PAS">Pasaporte</option>
                        <option value="RC">Registro Civil</option>
                    </select>
                    @error('tipo_doc')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="num_doc" class="form-label">Número de Documento</label>
                    <input type="text" name="num_doc" class="form-control" placeholder="Ingrese el número de documento" required>
                    @error('num_doc')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Ingrese su email" required>
                    @error('email')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" placeholder="Ingrese una contraseña" required>
                    @error('password')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">              
                    <label for="id_rol" class="form-label">Rol</label>
                    <select name="id_rol" class="form-control" required>
                        <option value="" selected disabled>Seleccione un rol..</option>
                        @foreach($roles as $rol)
                            <option value="{{ $rol->id_rol }}">{{ $rol->rol }}</option>
                        @endforeach
                    </select>
                    @error('id_rol')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                
            </div>

            <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-success" style="width: 150px; white-space: nowrap;">Crear Usuario</button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary" style="width: 100px; white-space: nowrap; margin-left: 10px;">Regresar</a>
            </div>
        </form>
    </div>
@endsection
