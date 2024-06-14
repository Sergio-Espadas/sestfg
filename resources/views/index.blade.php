<!-- resources/views/layouts/app.blade.php -->
@extends('layouts.personalizate')
<!DOCTYPE html>
@section('content')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Krav Maga Kapap Tml Ciudad Real</title>
</head>


<body>
    <header>
        <!-- Barra de navegación -->
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="{{ asset('assets/images/Logo/krav-Maga-Kapap-tml.png')}}" class="d-block navbar__image"
                        alt="Logo" />
                </a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto me-5">
                        <li class="nav-item">
                            <a class="nav-link text-light-custom fw-bold" aria-current="page"
                                href="{{ route('index') }}">Inicio</a>
                        </li>

                        @if (Route::has('login'))
                        @auth

                        <li class="nav-item">
                            <a class="nav-link text-light-custom fw-bold" href="{{ route('clases') }}">Clases</a>
                        </li>

                        @if(auth()->check() && auth()->user()->id_rol === 1)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light-custom fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Administración
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('trabajo.index') }}">Trabajos</a></li>
                                <li><a class="dropdown-item" href="{{ route('clase.index') }}">Clases</a></li>
                                <li><a class="dropdown-item" href="{{ route('aula.index') }}">Aula</a></li>
                                <li><a class="dropdown-item" href="{{ route('reserva.index') }}">Reservas</a></li>
                                <li><a class="dropdown-item" href="{{ route('tarifa.index') }}">Tarifas</a></li>
                                <li><a class="dropdown-item" href="{{ route('role.index') }}">Roles</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.index') }}">Usuarios</a></li>
                            </ul>
                        </li>
                        @endif

                        <!-- Settings Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light-custom fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Perfil') }}</a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">{{ __('Cerrar sesión') }}</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link text-light-custom fw-bold">Iniciar Sesión</a>
                        </li>

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link text-light-custom fw-bold">Registrarse</a>
                        </li>
                        @endif
                        @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Carrusel de fotos -->
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/images/Carrusel/first.jpg') }}" class="d-block w-100"
                        alt="Primera imagen" style="height: 100vh; object-fit: cover; object-position: 95% center;">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/images/Carrusel/second.jpg') }}" class="d-block w-100"
                        alt="Segunda imagen" style="height: 100vh; object-fit: cover; object-position: 50% center;">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/images/Carrusel/third.jpg') }}" class="d-block w-100"
                        alt="Tercera imagen" style="height: 100vh; object-fit: cover; object-position: 10% center;">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


    </header>

    <article class="overflow-x-hidden">
        <!-- Cajón de Eventos -->
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <h2 class="mb-4 event-title">Eventos</h2>
                </div>
            </div>
            <!-- Carrusel para pantallas pequeñas -->
            <div id="eventCarousel" class="carousel slide d-md-none" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- Evento 1 -->
                    <div class="carousel-item active">
                        <img src="{{ asset('assets/images/Eventos/tml_14.jpeg') }}" class="d-block w-100 img-fluid"
                            alt="Evento 1">
                    </div>
                    <!-- Evento 2 -->
                    <div class="carousel-item">
                        <img src="{{ asset('assets/images/Eventos/tml_18.jpeg') }}" class="d-block w-100 img-fluid"
                            alt="Evento 2">
                    </div>
                    <!-- Evento 3 -->
                    <div class="carousel-item">
                        <img src="{{ asset('assets/images/Eventos/tml_16.jpeg') }}" class="d-block w-100 img-fluid"
                            alt="Evento 3">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#eventCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#eventCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <!-- Cuadrícula para pantallas medianas y grandes -->
            <div class="row row-cols-1 row-cols-md-3 g-4 d-none d-md-flex">
                <!-- Evento 1 -->
                <div class="col">
                    <img src="{{ asset('assets/images/Eventos/tml_14.jpeg') }}" class="img-fluid rounded"
                        alt="Evento 1">
                </div>
                <!-- Evento 2 -->
                <div class="col">
                    <img src="{{ asset('assets/images/Eventos/tml_18.jpeg') }}" class="img-fluid rounded"
                        alt="Evento 2">
                </div>
                <!-- Evento 3 -->
                <div class="col">
                    <img src="{{ asset('assets/images/Eventos/tml_16.jpeg') }}" class="img-fluid rounded"
                        alt="Evento 3">
                </div>
            </div>
        </div>
    </article>
    <!-- Contenido de que es el Krav Maga -->
    <article>
        <div class="container text-center mt-5">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="card border-0 rounded shadow-sm h-100">
                        <img src="{{ asset('assets/images/Info extra/img1.jpg') }}" class="card-img-top"
                            alt="Krav Maga">
                        <div class="card-body d-flex flex-column">
                            <h2 class="card-title event-title">¿Qué es el Krav Maga?</h2>
                            <p class="card-text mb-4">
                                El Krav Maga o Krav Magá es el sistema oficial de lucha y defensa personal que utilizan
                                las Fuerzas de Defensa y Seguridad israelíes.
                            </p>
                            <p class="card-text mb-4">
                                Su nombre procede de krav (lucha) y magá (combate).
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 rounded shadow-sm h-100">
                        <img src="{{ asset('assets/images/Info extra/img2.jpg') }}" class="card-img-top" alt="TML">
                        <div class="card-body d-flex flex-column">
                            <h2 class="card-title event-title">¿Qué es el TML?</h2>
                            <p class="card-text mb-4">
                                El TEAM MARTÍN LUNA es un sistema de supervivencia propio, una línea de Krav Maga
                                desarrollada bajo el único principio de dar solución operativa real a cualquier posible
                                agresión, a mano vacía, mano con cuchillo, contra palo largo, corto, arma de fuego,
                                varios agresores…
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <article>
        @if (Route::has('login'))
        @auth
        <!-- Aquí no mostrará nada porque el usuario está autenticado -->
        @else

        @if (Route::has('register'))
        <!-- Contenido promocional para registrarse -->
        <div class="promocion__container text-center mt-5 mb-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="card border-0 rounded shadow-sm">
                        <div class="card-body">
                            <h2 class="card-title">¿Por qué entrenar en el TML Ciudad Real?</h2>
                            <p class="card-text">
                                Regístrate ahora y acude a tu primera clase de prueba para descubrir por ti mismo por
                                qué
                                deberías entrenar con nosotros.
                            </p>
                            <a href="{{ route('register') }}" class="btn btn-primary promocion__btn">Registrarse</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endauth
        @endif
    </article>

    <footer class="bg-dark text-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 p-4">
                    <h5 class="footer-title text-center p-3 mb-0">Contacto</h5>
                    <ul class="list-unstyled text-center">
                        <li>Teléfono: +1234567890</li>
                        <li>Email: admin@tml.com</li>
                    </ul>
                </div>
                <div class="col-md-4 p-2">
                    <h5 class="footer-title text-center p-3 mb-0">Redes</h5>
                    <ul class="list-unstyled d-flex justify-content-center">
                        <li class="mx-2">
                            <a href="#">
                                <img src="{{ asset('assets/images/redes/facebook.png')}}" class="navbar__image"
                                    alt="Facebook" style="max-width: 40px;" />
                            </a>
                        </li>
                        <li class="mx-2">
                            <a href="#">
                                <img src="{{ asset('assets/images/redes/tik-tok.png')}}" class="navbar__image"
                                    alt="TikTok" style="max-width: 40px;" />
                            </a>
                        </li>
                        <li class="mx-2">
                            <a href="#">
                                <img src="{{ asset('assets/images/redes/instagram.png')}}" class="navbar__image"
                                    alt="Instagram" style="max-width: 40px;" />
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 p-2">
                    <h5 class="footer-title text-center p-3 mb-0">Ubicación</h5>
                    <div
                        class="d-flex justify-content-center align-items-center embed-responsive embed-responsive-4by3">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6202.502206663218!2d-3.9343813249857233!3d38.98676514142769!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6bc36cc7ce4bd9%3A0xff53beff3f7f1cbd!2sNagare%20Dojo!5e0!3m2!1ses!2ses!4v1717953656452!5m2!1ses!2ses"
                            class="embed-responsive-item" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <hr class="bg-light mt-4">
            <p class="text-center mt-4">©2024 tml ciudad real.</p>
        </div>
    </footer>

</body>

</html>
@endsection