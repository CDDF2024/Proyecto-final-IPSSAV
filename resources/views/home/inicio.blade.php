@extends('layouts.app')
@section('title')
    Inicio
@endsection
@section('content')
<div class="container mt-5">
        @if(Auth::check())
            <div class="card text-center shadow-lg">
                <div class="card-header bg-success text-white">
                    <h2 class="text-white">Bienvenido a la IPSSAV de Vacunación y Muestras</h2>
                </div>
                <div class="card-body">
                    <h3>¡Hola, {{ Auth::user()->nombre }}!</h3>
                    <p class="lead">Tu rol es: <strong>{{ Auth::user()->rol->rol }}</strong></p>
                    <p>Estamos encantados de contar contigo en nuestro equipo. Tu compromiso es fundamental para el bienestar de nuestra comunidad.</p>
                    <hr>
                    <h4>¿Qué puedes hacer hoy?</h4>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-chart-line"></i> Consultar tus facturas.</li>
                    </ul>
                    <p>Recuerda que nuestro objetivo principal es proporcionar un servicio de salud eficiente y seguro para todos nuestros pacientes.</p>
                    <p>Si tienes alguna pregunta o necesitas ayuda, no dudes en ponerte en contacto con el equipo de soporte.</p>
                </div>
                <div class="card-footer text-muted">
                    &copy; {{ date('Y') }} IPS de Vacunación y Muestras. Todos los derechos reservados.
                </div>
            </div>
        @else
            <div class="alert alert-warning text-center">
                <p>No has iniciado sesión. Por favor, inicia sesión para acceder a más funcionalidades.</p>
            </div>
        @endif
    </div>
@endsection