@extends('layouts.personalizate')

@section('template_title')
{{ $tarifa->name ?? __('Mostrar') . " " . __('Tarifa') }}
@endsection

@section('content')
<section class="py-5 vh-100">
    <div class="container-fluid px-4 h-100">
        <div class="row justify-content-center h-100">
            <div class="col-12">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-admin text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ __('Mostrar') }} Tarifa</h4>
                        <a class="btn btn-light btn-sm" href="{{ route('tarifa.index') }}">{{ __('Volver') }}</a>
                    </div>

                    <div class="card-body bg-white p-4 h-100 d-flex flex-column">
                        <div class="row padding-1 p-1 h-100">
                            <div class="col-md-12">
                                <div class="form-group mb-2 mb-20">
                                    <strong class="text-secondary">{{ __('Nombre') }}:</strong>
                                    <p class="form-control-plaintext">{{ $tarifa->name }}</p>
                                </div>
                                <div class="form-group mb-2 mb-20">
                                    <strong class="text-secondary">{{ __('Precio') }}:</strong>
                                    <p class="form-control-plaintext">{{ $tarifa->price }}</p>
                                </div>
                                <div class="form-group mb-2 mb-20">
                                    <strong class="text-secondary">{{ __('Num Clases') }}:</strong>
                                    <p class="form-control-plaintext">{{ $tarifa->num_clases }}</p>
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