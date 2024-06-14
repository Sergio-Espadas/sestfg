@extends('layouts.personalizate')

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