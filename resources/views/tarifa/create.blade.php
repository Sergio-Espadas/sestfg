@extends('layouts.personalizate')

@section('template_title')
{{ __('Crear') }} Tarifa
@endsection

@section('content')
<section class="py-5 vh-100">
    <div class="container-fluid px-4">
        <div class="row justify-content-start">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-admin text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ __('Crear') }} Tarifa</h4>
                        <a class="btn btn-light btn-sm" href="{{ route('tarifa.index') }}">{{ __('Volver') }}</a>
                    </div>

                    <div class="bg-white p-4">
                        <form id="crear-tarifa-form" method="POST" action="{{ route('tarifa.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            @include('tarifa.form')

                            <div class="mt-4">
                                <button type="submit"
                                    class="btn btn-success admin-btn-create">{{ __('Crear') }}</button>
                                <a class="btn btn-secondary admin-btn-toggle"
                                    href="{{ route('tarifa.index') }}">{{ __('Cancelar') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection