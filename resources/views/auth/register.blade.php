<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Registro de Usuario</title>
    <link href="{{asset('css/register.css')}}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <form action="{{ route('auth.register') }}" method="POST" class="bg-form  p-4 rounded shadow" style="max-width: 500px; margin: auto;">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <a href="index.html" class="">
                    <h3 class="text-success"><i class="fa fa-hashtag me-2"></i>IPSSAV</h3>
                </a>
                <h3 class="text-success">Registro</h3>
            </div>
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingrese su apellido" required>
                </div>
            </div>
            <div class="form-group">
                <label for="tipo_doc">Tipo de Documento</label>
                <select class="form-control" id="tipo_doc" name="tipo_doc" required>
                    <option value="" disabled selected>Seleccione un tipo de documento</option>
                    <option value="CC">Cédula de Ciudadanía</option>
                    <option value="TI">Tarjeta de Identidad</option>
                    <option value="CE">Cédula de Extranjería</option>
                    <option value="PAS">Pasaporte</option>
                    <option value="RC">Registro Civil</option>
                </select>
            </div>
            <div class="form-group">
                <label for="num_doc">Número de Documento</label>
                <input type="text" class="form-control" id="num_doc" name="num_doc" placeholder="Ingrese el número de documento" required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su correo electrónico" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese una contraseña" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirme su contraseña" required>
                </div>
            </div>
            <input type="hidden" name="id_rol" value="4">
            <div class="text-center">
                <button type="submit" class="btn btn-success">Registrar</button>
                <a href="{{ url('/') }}" class="btn btn-secondary ">Regresar al Login</a>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
