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
            <div class="container-fluid d-flex justify-content-center align-items-center vh-110">
                <div class="card border-0 rounded shadow-sm" style="padding: 2rem; width: 100%;">
                    <div class="row g-0">
                        <!-- Columna de la imagen a la izquierda -->
                        <div class="col-md-5 d-none d-md-flex align-items-center">
                            <img src="{{ asset('assets/images/Register/register.jpg') }}"
                                class="img-fluid rounded-start h-90" alt="Imagen de fondo de registro">
                        </div>

                        <!-- Columna del formulario a la derecha -->
                        <div class="col-md-7 d-flex align-items-center">
                            <div class="card-body p-4">
                                <h2 class="card-title-login text-center mb-5 mt-2">{{ __('Registrar') }}</h2>
                                <form method="POST" action="{{ route('register') }}" class="row g-3"
                                    id="register-user-form">
                                    @csrf

                                    <div class="row">
                                        <!-- Name -->
                                        <div class="col-md-6 form-floating-login mb-3">
                                            <input id="name" class="form-control-login" type="text" name="name"
                                                :value="old('name')" autofocus autocomplete="name" placeholder=" ">
                                            <div id="nameError" class="invalid-feedback-login"></div>
                                            <label for="name">{{ __('Nombre') }}</label>
                                        </div>

                                        <!-- Apellido 1 -->
                                        <div class="col-md-6 form-floating-login mb-3">
                                            <input id="apellido_1" class="form-control-login" type="text"
                                                name="apellido_1" :value="old('apellido_1')" autofocus
                                                autocomplete="surname" placeholder=" ">
                                            <div id="apellido1Error" class="invalid-feedback-login"></div>
                                            <label for="apellido_1">{{ __('Primer Apellido') }}</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Apellido 2 -->
                                        <div class="col-md-6 form-floating-login mb-3">
                                            <input id="apellido_2" class="form-control-login" type="text"
                                                name="apellido_2" :value="old('apellido_2')" autofocus
                                                autocomplete="second-surname" placeholder=" ">
                                            <div id="apellido2Error" class="invalid-feedback-login"></div>
                                            <label for="apellido_2">{{ __('Segundo Apellido') }}</label>
                                        </div>

                                        <!-- DNI -->
                                        <div class="col-md-6 form-floating-login mb-3">
                                            <input id="dni" class="form-control-login" type="text" name="dni"
                                                :value="old('dni')" autofocus autocomplete="dni" placeholder=" ">
                                            <div id="dniError" class="invalid-feedback-login">@error('dni')
                                                <div class="invalid-feedback-login">
                                                    {{ __('Recuerda que solo puede existir una cuenta relacionada a un DNI') }}
                                                </div>
                                                @enderror
                                            </div>
                                            <label for="dni">{{ __('DNI') }}</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Email Address -->
                                        <div class="col-12 form-floating-login mb-3">
                                            <input id="email" class="form-control-login" type="email" name="email"
                                                :value="old('email')" autocomplete="username" placeholder=" ">
                                            <div id="emailError" class="invalid-feedback-login">
                                                @error('email')
                                                <div class="invalid-feedback-login">
                                                    {{ __('Recuerda que solo puede existir una cuenta relacionada a un Email') }}
                                                </div>
                                                @enderror
                                            </div>
                                            <label for="email">{{ __('Correo electrónico') }}</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Password -->
                                        <div class="col-md-6 form-floating-login mb-3">
                                            <input id="password" class="form-control-login" type="password"
                                                name="password" autocomplete="new-password" placeholder=" ">
                                            <div id="passwordError" class="invalid-feedback-login"></div>
                                            <label for="password">{{ __('Contraseña') }}</label>
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="col-md-6 form-floating-login mb-3">
                                            <input id="password_confirmation" class="form-control-login" type="password"
                                                name="password_confirmation" autocomplete="new-password"
                                                placeholder=" ">
                                            <div id="passwordConfirmationError" class="invalid-feedback-login"></div>
                                            <label for="password_confirmation">{{ __('Confirmar contraseña') }}</label>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <button class="btn btn-primary-login btn-block"
                                            type="submit">{{ __('Registrar') }}</button>
                                    </div>

                                    <div class="col-12 mt-3 text-center">
                                        <p class="text-sm text-gray-600-login">{{ __('¿Ya estas registrado?') }} <a
                                                href="{{ route('login') }}"
                                                class="text-link-login">{{ __('Inicia sesión') }}</a></p>
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