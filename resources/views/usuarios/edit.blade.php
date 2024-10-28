@extends('layouts.app')

@section('title')
    Editar Usuario
@stop

@section('content')
    <div class="container">
        <h1 class="text-center mb-3">Editar Usuario</h1>
        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded shadow-sm" style="max-width: 700px; margin: auto;">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $usuario->nombre) }}" placeholder="Ingrese su nombre" required>
                        @error('nombre')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" name="apellido" class="form-control" value="{{ old('apellido', $usuario->apellido) }}" placeholder="Ingrese su apellido" required>
                        @error('apellido')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tipo_doc" class="form-label">Tipo de Documento</label>
                        <select name="tipo_doc" class="form-control" required>
                            <option value="{{ $usuario->tipo_doc }}">{{ $usuario->tipo_doc }}</option>
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
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="num_doc" class="form-label">Número de Documento</label>
                        <input type="text" name="num_doc" class="form-control" value="{{ old('num_doc', $usuario->num_doc) }}" placeholder="Ingrese el número de documento" required>
                        @error('num_doc')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $usuario->email) }}" placeholder="Ingrese su email" required>
                    @error('email')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="pass" class="form-label">Contraseña</label>
                        <input type="password" name="pass" class="form-control" placeholder="Deja en blanco si no deseas cambiar la contraseña.">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">              
                    <div class="mb-3">
                        <label for="id_rol" class="form-label">Rol</label>
                        <select name="id_rol" class="form-control" required>
                            
                            @foreach($roles as $rol)
                                <option value="{{ $rol->id_rol }}" {{ $usuario->id_rol == $rol->id_rol ? 'selected' : '' }}>
                                    {{ $rol->rol }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_rol')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-success" style="width: 150px; white-space: nowrap;">Actualizar Usuario</button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary" style="width: 100px; white-space: nowrap; margin-left: 10px;">Regresar</a>
            </div>
        </form>
    </div>
@stop
