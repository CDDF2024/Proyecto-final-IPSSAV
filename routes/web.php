<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\BiologicosController;
use App\Http\Controllers\MuestrasController;
use App\Http\Controllers\EsquemasController;
use App\Http\Controllers\ResultadosController;
use App\Http\Controllers\ResultadosPacienteController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\DetallesFacturaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\InventariosController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('index', function () {
    return view('auth.login');
})->name('index');

Route::get('register', function () {
    return view('auth.register');
});

Route::get('logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::post('register', [AuthController::class, 'register'])->name('auth.register');
Route::post('check', [AuthController::class, 'check'])->name('auth.login');
Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

// FILTRO DE BUSQUEDA
Route::get('/usuarios/buscar', [UsuariosController::class, 'buscar'])->name('usuarios.buscar');
Route::get('/roles/buscarRoles', [RolesController::class, 'buscarRoles'])->name('roles.buscarRoles');
Route::get('/pacientes/buscar', [PacientesController::class, 'buscar'])->name('pacientes.buscar');
Route::get('/clientes/buscar', [ClienteController::class, 'buscar'])->name('clientes.buscar');
Route::get('/biologicos/buscar', [BiologicosController::class, 'buscar'])->name('biologicos.buscar');
Route::get('/muestras/buscar', [MuestrasController::class, 'buscar'])->name('muestras.buscar');
Route::get('/esquemas/buscar', [EsquemasController::class, 'buscar'])->name('esquemas.buscar');
Route::get('/facturas/buscar', [FacturasController::class, 'buscar'])->name('facturas.buscar');
Route::get('/servicios/buscar', [ServiciosController::class, 'buscar'])->name('servicios.buscar');
Route::get('/resultados/buscar', [ResultadosController::class, 'buscar'])->name('resultados.buscar');
Route::get('/inventarios/buscar', [InventariosController::class, 'buscar'])->name('inventarios.buscar');



// Ruta para manejar la búsqueda
Route::post('/buscar', [ResultadosController::class, 'buscar']);
Route::get('/resultados', [TuControlador::class, 'mostrarResultados']);
Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('dashboard');
    })->name('home');
    Route::get('inicio', function () {
        return view('home.inicio');
    })->name('inicio');
    // Ruta para la vista de búsqueda
    Route::get('/misresultados', function () {
        return view('resultados.buscar', ['resultados' => null]);
    })->name('buscarResultados'); 
    Route::resource('usuarios', UsuariosController::class);
    Route::resource('pacientes', PacientesController::class);
    Route::resource('roles', RolesController::class);
    Route::resource('biologicos', BiologicosController::class);
    Route::resource('muestras', MuestrasController::class);
    Route::resource('esquemas', EsquemasController::class);
    Route::resource('resultados', ResultadosController::class);
    Route::resource('servicios', ServiciosController::class);
    Route::resource('facturas', FacturasController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('inventarios', InventariosController::class);
    Route::post('facturas/{factura}/detalles', [DetallesController::class, 'store'])->name('detalles.store');
    Route::get('/factura/exportar/{id}', [FacturasController::class, 'exportar'])->name('factura.exportar');
});
Route::middleware(['auth', 'admin'])->group(function () {
    
    Route::get('/misresultados', function () {
        return view('resultados.buscar', ['resultados' => null]);
    })->name('buscarResultados'); 

});
Route::middleware(['auth', 'facturador'])->group(function () {
    Route::resource('usuarios', UsuariosController::class);
    Route::resource('pacientes', PacientesController::class);
    Route::resource('roles', RolesController::class);
    Route::resource('biologicos', BiologicosController::class);
    Route::resource('muestras', MuestrasController::class);
    Route::resource('esquemas', EsquemasController::class);
    Route::resource('resultados', ResultadosController::class);
    Route::resource('inventarios', InventariosController::class);
});
Route::middleware(['auth', 'auxiliar'])->group(function () {
    Route::resource('usuarios', UsuariosController::class);
    Route::resource('roles', RolesController::class);
    Route::resource('servicios', ServiciosController::class);
    Route::resource('facturas', FacturasController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('inventarios', InventariosController::class);
    Route::post('facturas/{factura}/detalles', [DetallesController::class, 'store'])->name('detalles.store');
    Route::get('/factura/exportar/{id}', [FacturasController::class, 'exportar'])->name('factura.exportar');

});
Route::middleware(['auth', 'paciente'])->group(function () {
    Route::resource('usuarios', UsuariosController::class);
    Route::resource('pacientes', PacientesController::class);
    Route::resource('roles', RolesController::class);
    Route::resource('biologicos', BiologicosController::class);
    Route::resource('muestras', MuestrasController::class);
    Route::resource('esquemas', EsquemasController::class);
    Route::resource('resultados', ResultadosController::class);
    Route::resource('servicios', ServiciosController::class);
    Route::resource('facturas', FacturasController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('inventarios', InventariosController::class);
});