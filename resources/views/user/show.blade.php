@extends('layouts.personalizate')

@section('template_title')
{{ $user->name ?? __('Mostrar') . " " . __('Usuario') }}
@endsection

@section('content')
<section class="py-5 vh-100">
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-admin text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ __('Mostrar') }} Usuario</h4>
                        <a class="btn btn-light btn-sm" href="{{ route('user.index') }}">{{ __('Volver') }}</a>
                    </div>

                    <div class="card-body bg-white p-4">
                        <div class="row padding-1 p-1">
                            <div class="col-md-12">
                                <div class="form-group mb-2 mb-20">
                                    <strong class="text-secondary">{{ __('Nombre') }}:</strong>
                                    <p class="form-control-plaintext">{{ $user->name }}</p>
                                </div>
                                <div class="form-group mb-2 mb-20">
                                    <strong class="text-secondary">{{ __('Apellido 1') }}:</strong>
                                    <p class="form-control-plaintext">{{ $user->apellido_1 }}</p>
                                </div>
                                <div class="form-group mb-2 mb-20">
                                    <strong class="text-secondary">{{ __('Apellido 2') }}:</strong>
                                    <p class="form-control-plaintext">{{ $user->apellido_2 }}</p>
                                </div>
                                <div class="form-group mb-2 mb-20">
                                    <strong class="text-secondary">{{ __('Email') }}:</strong>
                                    <p class="form-control-plaintext">{{ $user->email }}</p>
                                </div>
                                <div class="form-group mb-2 mb-20">
                                    <strong class="text-secondary">{{ __('DNI') }}:</strong>
                                    <p class="form-control-plaintext">{{ $user->dni }}</p>
                                </div>
                                <div class="form-group mb-2 mb-20">
                                    <strong class="text-secondary">{{ __('Tarifa') }}:</strong>
                                    <p class="form-control-plaintext">{{ $user->tarifa->name ?? 'N/A' }}</p>
                                </div>
                                <div class="form-group mb-2 mb-20">
                                    <strong class="text-secondary">{{ __('Rol') }}:</strong>
                                    <p class="form-control-plaintext">{{ $user->rol->name ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection