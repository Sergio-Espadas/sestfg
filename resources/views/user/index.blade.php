@extends('layouts.personalizate')
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
                            <h4 class="mb-0 fw-bold">Usuarios</h4>
                        </div>

                        @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                        @endif

                        <div class="card-body bg-white">
                            <form method="GET" action="{{ route('user.index') }}" class="mb-4">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-3 mt-2">
                                        <div class="input-group">
                                            <label class="input-group-text" for="search_name">Nombre</label>
                                            <input type="text" name="search_name" class="form-control"
                                                placeholder="Buscar nombre/apellidos"
                                                value="{{ request('search_name') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <div class="input-group">
                                            <label class="input-group-text" for="search_dni">DNI</label>
                                            <input type="text" name="search_dni" class="form-control"
                                                placeholder="Buscar DNI" value="{{ request('search_dni') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <div class="input-group">
                                            <label class="input-group-text" for="search_email">Email</label>
                                            <input type="email" name="search_email" class="form-control"
                                                placeholder="Buscar email" value="{{ request('search_email') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <div class="input-group">
                                            <label class="input-group-text" for="sort_by">Ordenar</label>
                                            <select name="sort_by" class="form-control">
                                                <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>ID
                                                </option>
                                                <option value="name"
                                                    {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                                                <option value="apellido_1"
                                                    {{ request('sort_by') == 'apellido_1' ? 'selected' : '' }}>Apellido
                                                    1</option>
                                                <option value="apellido_2"
                                                    {{ request('sort_by') == 'apellido_2' ? 'selected' : '' }}>Apellido
                                                    2</option>
                                                <option value="email"
                                                    {{ request('sort_by') == 'email' ? 'selected' : '' }}>Email</option>
                                                <option value="dni" {{ request('sort_by') == 'dni' ? 'selected' : '' }}>
                                                    DNI</option>
                                                <option value="tarifa_id"
                                                    {{ request('sort_by') == 'tarifa_id' ? 'selected' : '' }}>Tarifa
                                                </option>
                                                <option value="rol_id"
                                                    {{ request('sort_by') == 'rol_id' ? 'selected' : '' }}>Rol</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
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
                                    <div class="col-md-3 d-flex align-items-end justify-content-end">
                                        <button type="submit" class="btn admin-btn-toggle me-2">Filtrar</button>
                                        <a href="{{ route('user.index') }}" class="btn admin-btn-toggle">Limpiar</a>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive mt-3">
                                <table class="table table-striped table-hover text-center">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Nombre</th>
                                            <th>Apellido 1</th>
                                            <th>Apellido 2</th>
                                            <th>Email</th>
                                            <th>DNI</th>
                                            <th>Tarifa</th>
                                            <th>Rol</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->apellido_1 }}</td>
                                            <td>{{ $user->apellido_2 }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->dni }}</td>
                                            <td>{{ $user->tarifa->name ?? 'N/A' }}</td>
                                            <td>{{ $user->rol->name ?? 'N/A' }}</td>
                                            <td>
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                                    <a class="btn admin-btn-show btn-sm m-1"
                                                        href="{{ route('user.show', $user->id) }}">Mostrar</a>
                                                    <a class="btn admin-btn-edit btn-sm m-1"
                                                        href="{{ route('user.edit', $user->id) }}">Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn admin-btn-delete btn-sm m-1"
                                                        onclick="event.preventDefault(); confirm('¿Está seguro de que desea eliminar este usuario?') ? this.closest('form').submit() : false;">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {!! $users->withQueryString()->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>


</body>

</html>
@endsection