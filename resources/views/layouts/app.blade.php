<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <script src="https://kit.fontawesome.com/24c84516fd.js" crossorigin="anonymous"></script>


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    @yield('scripts')
    @yield('style')
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                <div class="spinner-border text-success" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Cargando...</span>
                </div>
        </div>
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar">
                <a href="index.html" class="navbar-brand mx-4 mb-3 logo ">
                    <img src="{{asset('img/logo_ipssav.svg')}}" alt="" class="img-fluid">
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle bg-light" src="{{asset('img/predeterminada.jpg')}}" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</h6>
                        <span>{{ Auth::user()->rol->rol }}</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="{{url('home')}}" class="nav-item nav-link"><i class="fa-solid fa-house"></i>Inicio</a>
                    @if(auth::user()->rol->id_rol===1)
                    <a href="{{url('usuarios')}}" class="nav-item nav-link"><i class="fa-solid fa-users-gear"></i>Usuarios</a>
                    <a href="{{url('roles')}}" class="nav-item nav-link"><i class="fa-solid fa-address-book"></i>Roles</a>
                    @endif
                    @if(auth::user()->rol->id_rol === 3 || auth::user()->rol->id_rol === 1)
                    <a href="{{url('pacientes')}}" class="nav-item nav-link"><i class="fa-solid fa-hospital-user"></i>Pacientes</a>
                    @endif
                    @if(auth::user()->rol->id_rol === 1 || auth::user()->rol->id_rol === 2)
                    <a href="{{url('clientes')}}" class="nav-item nav-link"><i class="fa-solid fa-users-line"></i>Clientes</a>
                    @endif
                    @if(auth::user()->rol->id_rol === 3 || auth::user()->rol->id_rol === 1)
                    <a href="{{url('biologicos')}}" class="nav-item nav-link"><i class="fa-solid fa-syringe"></i>Biologicos</a>
                    <a href="{{url('muestras')}}" class="nav-item nav-link"><i class="fa-solid fa-vial-circle-check"></i>Muestras</a>
                    <a href="{{url('esquemas')}}" class="nav-item nav-link"><i class="fa-solid fa-address-card"></i>Esquemas</a>
                    <a href="{{url('resultados')}}" class="nav-item nav-link"><i class="fa-solid fa-newspaper"></i>Resultados</a>
                    @endif
                    @if(auth::user()->rol->id_rol === 1 || auth::user()->rol->id_rol === 2)
                    <a href="{{url('facturas')}}" class="nav-item nav-link"><i class="fa-solid fa-file-invoice"></i>Facturas</a>
                    <a href="{{url('servicios')}}" class="nav-item nav-link"><i class="fa-solid fa-hospital"></i>Servicios</a>
                    @endif
                    @if(auth::user()->rol->id_rol===1)
                    <a href="{{url('inventarios')}}" class="nav-item nav-link"><i class="fa-solid fa-cart-flatbed"></i></i>Inventario</a>
                    @endif
                    @if(auth::user()->rol->id_rol===4)
                    <a href="{{url('/misresultados')}}" class="nav-item nav-link"><i class="fa-solid fa-file-contract"></i></i></i>Resultados</a>
                    @endif
                </div>
            </nav>
        </div>
        <div class="content">
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-success mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa-solid fa-bars-staggered" style="color: #20a01c;"></i>
                </a>
                <div class="d-none d-md-flex mt-2 txt-dash">
                    <h3 class="text-success"></i>IPS SAV DASHBOARD</h3>
                </div>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="{{asset('img/predeterminada.jpg')}}" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item" id="openModalButton">Mi Perfil</a>
                            <a href="{{ url('logout') }}" class="dropdown-item">Cerrar Sesion</a>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="miModalLabel">Perfil de Usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="imagen-modal">
                                <img class="rounded-circle me-lg-2 text-center" src="{{asset('img/predeterminada.jpg')}}" alt="Imagen de perfil" style="width: 120px; height: 120px;">
                            </div>
                            <div class="perfil-info">
                                <span>Nombre: {{ Auth::user()->nombre }} {{ Auth::user()->apellido }} </span><br>
                                <span>Rol: {{ Auth::user()->rol->rol }}</span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid pt-4 px-4">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script>
        document.getElementById('openModalButton').addEventListener('click', function () {
            var myModal = new bootstrap.Modal(document.getElementById('miModal'), {
                keyboard: true
            });
            myModal.show();
        });
    </script>
    @yield('script')
</body>
</html>