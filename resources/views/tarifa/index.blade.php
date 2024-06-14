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
                            <h4 class="mb-0 fw-bold">Tarifas</h4>
                            <div class="ms-auto">
                                <a href="{{ route('tarifa.create') }}" class="btn admin-btn-create btn-sm">Crear
                                    Nuevo</a>
                            </div>
                        </div>
                    </div>

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success m-4">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    @if ($error_message = Session::get('error'))
                    <div class="alert alert-danger m-4">
                        <p>{{ $error_message }}</p>
                    </div>
                    @endif

                    <div class="admin-card-body bg-white">
                        <form action="{{ route('tarifa.index') }}" method="GET" class="mb-4">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <label class="input-group-text" for="sort_by">Nombre</label>
                                        <input type="text" name="search_name" class="form-control"
                                            placeholder="Buscar por nombre" value="{{ request('search_name') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <label class="input-group-text" for="sort_by">Precio</label>
                                        <input type="number" name="search_price" class="form-control"
                                            placeholder="Buscar por precio" value="{{ request('search_price') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <label class="input-group-text" for="sort_by">Num Clases</label>
                                        <input type="number" name="search_num_clases" class="form-control"
                                            placeholder="Buscar por número de clases"
                                            value="{{ request('search_num_clases') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <label class="input-group-text" for="sort_by">Ordenar</label>
                                        <select name="sort_by" class="form-select" id="sort_by">
                                            <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>ID
                                            </option>
                                            <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>
                                                Nombre
                                            </option>
                                            <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>
                                                Precio
                                            </option>
                                            <option value="num_clases"
                                                {{ request('sort_by') == 'num_clases' ? 'selected' : '' }}>Número de
                                                Clases
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 d-flex align-items-center justify-content-end">
                                    <button type="submit" class="btn admin-btn-toggle me-2">Filtrar</button>
                                    <a href="{{ route('tarifa.index') }}" class="btn admin-btn-toggle">Limpiar</a>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Número de Clases</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tarifas as $tarifa)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $tarifa->name }}</td>
                                        <td>{{ $tarifa->price }}</td>
                                        <td>{{ $tarifa->num_clases }}</td>
                                        <td>
                                            <form action="{{ route('tarifa.destroy', $tarifa->id) }}" method="POST"
                                                class="d-inline">
                                                <a href="{{ route('tarifa.show', $tarifa->id) }}"
                                                    class="btn admin-btn-show btn-sm m-1">Mostrar</a>
                                                <a href="{{ route('tarifa.edit', $tarifa->id) }}"
                                                    class="btn admin-btn-edit btn-sm m-1">Editar</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn admin-btn-delete btn-sm m-1"
                                                    onclick="return confirm('¿Está seguro de que desea eliminar esta tarifa?');">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {!! $tarifas->withQueryString()->links() !!}
                    </div>
                </div>
            </div>
        </div>
        </div>
    </article>

</body>

</html>
@endsection