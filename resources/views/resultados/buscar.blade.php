@extends('layouts.app')

@section('content')


    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <h1 class="text-center mb-4">Buscar Resultados de Tomadas de Muestra</h1>
        <form action="buscar" method="POST" class="w-50">
            @csrf
            <div class="input-group mb-3">
                <input type="text" id="num_doc" name="num_doc" class="form-control" placeholder="Número de Documento" required>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>
@endsection
