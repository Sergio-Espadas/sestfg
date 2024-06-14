@extends('layouts.personalizate')

@section('template_title')
{{ $clase->name ?? __('Mostrar') . " " . __('Clase') }}
@endsection

@section('content')
<section class="py-5 vh-100 d-flex align-items-center">
    <div class="container-fluid px-4 h-100">
        <div class="row justify-content-center h-100">
            <div class="col-12 h-100">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-admin text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ __('Mostrar') }} Clase</h4>
                        <a class="btn btn-light btn-sm" href="{{ route('clase.index') }}"> {{ __('Volver') }}</a>
                    </div>

                    <div class="card-body bg-white p-4 h-100 d-flex flex-column">
                        <div class="row p-1 h-100">
                            <div class="col-md-12">
                                <div class="form-group mb-2 mb20">
                                    <strong class="text-secondary">{{ __('Nombre Aula') }}:</strong>
                                    <p class="form-control-plaintext">{{ $clase->aula->nombre }}</p>
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong class="text-secondary">{{ __('Nombre Trabajo') }}:</strong>
                                    <p class="form-control-plaintext">{{ $clase->trabajo->nombre }}</p>
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong class="text-secondary">{{ __('Fecha') }}:</strong>
                                    <p class="form-control-plaintext">{{ $clase->fecha }}</p>
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong class="text-secondary">{{ __('Hora') }}:</strong>
                                    <p class="form-control-plaintext">{{ $clase->hora }}</p>
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