@extends('layouts.personalizate')
@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Krav Maga Kapap Tml Ciudad Real</title>
</head>

<body>
    <header>
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-lg navbar-crud">
            <div class="container-fluid">
                <a class="navbar-brand ms-2" href="{{ route('index') }}">
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
    <article class="py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div
                            class="admin-card-header bg-admin text-white d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 fw-bold">Clases</h4>
                            <div class="ms-auto">
                                <a href="{{ route('clase.create') }}" class="btn admin-btn-create btn-sm">Crear
                                    Nuevo</a>
                            </div>
                        </div>

                        @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                        @endif

                        @if ($message = Session::get('error'))
                        <div class="alert alert-danger m-4">
                            <p>{{ $message }}</p>
                        </div>
                        @endif

                        <div class="card-body bg-white">
                            <form method="GET" action="{{ route('clase.index') }}" class="mb-4">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <label class="input-group-text" for="search_aula">Aula</label>
                                            <input type="text" name="search_aula" class="form-control"
                                                placeholder="Nombre de aula" value="{{ request('search_aula') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <label class="input-group-text" for="search_trabajo">Trabajo</label>
                                            <input type="text" name="search_trabajo" class="form-control"
                                                placeholder="Nombre del trabajo"
                                                value="{{ request('search_trabajo') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <label class="input-group-text" for="search_clase">Clases</label>
                                            <select name="search_clase" class="form-select">
                                                <option value="">Seleccionar Clase</option>
                                                @foreach($allClases as $clase)
                                                <option value="{{ $clase->id }}"
                                                    {{ request('search_clase') == $clase->id ? 'selected' : '' }}>
                                                    {{ $clase->fecha }} - {{ $clase->hora }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <label class="input-group-text" for="sort_by">Ordenar</label>
                                            <select name="sort_by" class="form-control">
                                                <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>ID
                                                </option>
                                                <option value="id_aula"
                                                    {{ request('sort_by') == 'id_aula' ? 'selected' : '' }}>Aula
                                                </option>
                                                <option value="id_trabajo"
                                                    {{ request('sort_by') == 'id_trabajo' ? 'selected' : '' }}>
                                                    Trabajo
                                                </option>
                                                <option value="fecha"
                                                    {{ request('sort_by') == 'fecha' ? 'selected' : '' }}>Fecha
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <label class="input-group-text" for="sort_direction">Dirección</label>
                                            <select name="sort_direction" class="form-control">
                                                <option value="asc"
                                                    {{ request('sort_direction') == 'asc' ? 'selected' : '' }}>
                                                    Ascendente</option>
                                                <option value="desc"
                                                    {{ request('sort_direction') == 'desc' ? 'selected' : '' }}>
                                                    Descendente</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 d-flex align-items-center justify-content-end">
                                        <button type="submit" class="btn admin-btn-toggle me-2">Filtrar</button>
                                        <a href="{{ route('clase.index') }}" class="btn admin-btn-toggle">Limpiar</a>
                                    </div>

                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover text-center">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Id</th>
                                            <th>Aula</th>
                                            <th>Trabajo</th>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Acciones</th> <!-- Traducción de "Actions" -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clases as $clase)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $clase->aula->nombre }}</td>
                                            <td>{{ $clase->trabajo->nombre }}</td>
                                            <td>{{ $clase->fecha }}</td>
                                            <td>{{ $clase->hora }}</td>
                                            <td>
                                                <form action="{{ route('clase.destroy', $clase->id) }}" method="POST">
                                                    <a class="btn admin-btn-show btn-sm m-1"
                                                        href="{{ route('clase.show', $clase->id) }}">
                                                        Mostrar
                                                    </a>
                                                    <a class="btn admin-btn-edit btn-sm m-1"
                                                        href="{{ route('clase.edit', $clase->id) }}">
                                                        Editar
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn admin-btn-delete btn-sm m-1"
                                                        onclick="event.preventDefault(); confirm('¿Estás seguro de que deseas eliminar?') ? this.closest('form').submit() : false;">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {!! $clases->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

</body>

</html>
@endsection