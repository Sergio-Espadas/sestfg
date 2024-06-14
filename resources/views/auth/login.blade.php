@extends('layouts.personalizate')

<!DOCTYPE html>
@section('content')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Krav Maga Kapap Tml Ciudad Real</title>
</head>
<article>
    <div class="container-fluid p-0">
        <div class="position-relative">
            <div class="container-fluid d-flex justify-content-center align-items-center vh-100">
                <div class="card border-0 rounded shadow-sm" style="padding: 4rem; width: 100%;">
                    <div class="row g-0">
                        <!-- Columna de la imagen a la izquierda -->
                        <div class="col-md-5 d-none d-md-flex align-items-center">
                            <img src="{{ asset('assets/images/Login/login.jpg')}}" class="img-fluid rounded-start h-100"
                                alt="Imagen de fondo de login">
                        </div>

                        <!-- Columna del formulario a la derecha -->
                        <div class="col-md-7 d-flex align-items-center">
                            <div class="card-body p-4">
                                <h2 class="card-title-login text-center mb-4">{{ __('Iniciar Sesión') }}</h2>
                                <form id="loginAuthForm" method="POST" action="{{ route('login') }}"
                                    class="row g-3 needs-validation" novalidate>
                                    @csrf

                                    <!-- Email Address -->
                                    <div class="col-12 form-floating-login mb-3">
                                        <input id="email" class="form-control-login" type="email" name="email"
                                            :value="old('email')" required autofocus autocomplete="username"
                                            placeholder=" " />
                                        <div class="invalid-feedback-login">
                                            @error('email')
                                            <div class="invalid-feedback-login">
                                                {{ __('El correo electrónico o la contraseña son incorrectos.') }}
                                            </div>
                                            @enderror
                                        </div>
                                        <label for="email">{{ __('Correo electrónico') }}</label>
                                    </div>

                                    <!-- Password -->
                                    <div class="col-12 form-floating-login mb-3">
                                        <input id="password" class="form-control-login" type="password" name="password"
                                            required autocomplete="current-password" placeholder=" " />
                                        <div class="invalid-feedback-login"></div>
                                        <label for="password">{{ __('Contraseña') }}</label>
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="col-12 mb-3">
                                        <div class="form-check">
                                            <input id="remember_me" type="checkbox" class="form-check-input-login"
                                                name="remember">
                                            <label for="remember_me"
                                                class="form-check-label-login">{{ __('Recuérdame') }}</label>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-primary-login btn-block" type="submit">
                                                {{ __('Iniciar sesión') }}
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-3 text-center">
                                        <p class="text-sm text-gray-600-login">{{ __('¿Aún no te has registrado?') }} <a
                                                href="{{ route('register') }}"
                                                class="text-link-login">{{ __('Regístrate aquí') }}</a>
                                        </p>
                                    </div>
                                    <div class="col-12 mt-3 text-center">
                                        <p class="text-sm text-gray-600-login">{{ __('¿Volver al inicio?') }} <a
                                                href="{{ route('index') }}" class="text-link-login">{{ __('Aquí') }}</a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</article>
</body>

</html>
@endsection