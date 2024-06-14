@extends('layouts.personalizate')

@section('content')
<header>
    <nav class="navbar navbar-expand-lg navbar-crud">
        <div class="container-fluid">
            <a class="navbar-brand ms-2" href="{{ route('index') }}">
                <img src="{{ asset('assets/images/Logo/krav-Maga-Kapap-tml.png')}}" class="d-block navbar__image"
                    alt="Logo" />
            </a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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

</header>

<div class="container mt-4">
    <div class="text-center mb-4 button-container">
        <button id="btnClasesDisponibles" class="btn custom-btn-toggle active">Clases Disponibles</button>
        <button id="btnMisClases" class="btn custom-btn-toggle">Mis Clases</button>
    </div>
    <div id="clasesDisponibles" class="row flex-wrap">
        <h2 class="section-title text-center w-100">Clases Disponibles</h2>
        @if ($user && !$user->id_tarifa)
        <div class="alert alert-warning" role="alert">
            Contacte con su filial y solicite una tarifa para poder reservar clases.
        </div>
        @else
        @foreach ($clases as $clase)
        @if (Auth::check() && !Auth::user()->reservas()->where('id_clase', $clase->id)->exists())
        <div class="col-md-6 col-sm-12 mb-4">
            <div class="card custom-card animate__animated animate__fadeInUp">
                <img src="{{ asset('assets/images/Carrusel/second.jpg') }}" class="card-img"
                    alt="No se puede mostrar la imagen">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $clase->nombre }}</h5>
                    <p class="card-text">
                        <strong>Fecha:</strong> <em>{{ $clase->fecha }}</em>, <strong>Hora:</strong>
                        <em>{{ $clase->hora }}</em> <br>
                        <strong>Trabajo:</strong> <em>{{ $clase->trabajo->nombre }}</em> <br>
                        <strong>Aula:</strong> <em>{{ $clase->aula->nombre }}</em> <br>
                        <strong>Gente apuntada:</strong> <em>{{ $clase->numero_reservas }} /
                            {{ $clase->aula->capacidad }}</em>
                    </p>
                    @if ($clase->numero_reservas == $clase->aula->capacidad)
                    <div class="alert alert-danger" role="alert">
                        Se ha completado el aforo de la clase
                    </div>
                    @elseif (auth()->user()->cupos_clases == 0)
                    <div class="alert alert-danger" role="alert">
                        Ya utilizaste todas tus clases este mes.
                    </div>
                    @else
                    <form action="{{ route('reservar-clase', $clase->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn custom-btn">Reservar esta clase</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>

        @endif
        @endforeach
        @endif
    </div>

    <div id="misClases" class="row flex-wrap" style="display: none;">
        <h2 class="section-title text-center w-100">Mis Clases</h2>
        @foreach ($clases as $clase)
        @if (Auth::check() && Auth::user()->reservas()->where('id_clase', $clase->id)->exists())
        <div class="col-md-6 col-sm-12 mb-4">
            <div class="card custom-card animate__animated animate__fadeInUp">
                <img src="{{ asset('assets/images/Carrusel/third.jpg') }}" class="card-img"
                    alt="No se puede mostrar la imagen">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $clase->nombre }}</h5>
                    <p class="card-text">
                        <strong>Fecha:</strong> <em>{{ $clase->fecha }}</em>, <strong>Hora:</strong>
                        <em>{{ $clase->hora }}</em> <br>
                        <strong>Trabajo:</strong> <em>{{ $clase->trabajo->nombre }}</em> <br>
                        <strong>Aula:</strong> <em>{{ $clase->aula->nombre }}</em> <br>
                        <strong>Gente apuntada:</strong> <em>{{ $clase->numero_reservas }} /
                            {{ $clase->aula->capacidad }}</em>
                    </p>
                    <form action="{{ route('cancelar-reserva', $clase->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn custom-btn-danger">Cancelar reserva</button>
                    </form>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>

<!-- Modal para mostrar el éxito de la reserva -->
@if(session('success') && session('claseReservada'))
<div class="modal fade" id="reservaModal" tabindex="-1" aria-labelledby="reservaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content custom-modal">
            <img src="{{ asset('assets/images/Logo/krav-Maga-Kapap-tml.png') }}" class="modal-img"
                alt="No se puede mostrar la imagen">
            <div class="modal-header">
                <h5 class="modal-title" id="reservaModalLabel">Clase Reservada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Has reservado la clase exitosamente.</p>
                <p><strong>Fecha:</strong> {{ session('claseReservada')->fecha }}</p>
                <p><strong>Hora:</strong> {{ session('claseReservada')->hora }}</p>
                <p><strong>Aula:</strong> {{ session('claseReservada')->aula->nombre }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn custom-btn" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endif

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
                            <img src="{{ asset('assets/images/redes/tik-tok.png')}}" class="navbar__image" alt="TikTok"
                                style="max-width: 40px;" />
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
                <div class="d-flex justify-content-center align-items-center embed-responsive embed-responsive-4by3">
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

@endsection