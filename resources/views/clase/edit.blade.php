@extends('layouts.personalizate')

@section('template_title')
{{ __('Actualizar') }} Clase
@endsection

@section('content')
<section class="py-5 vh-100">
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-admin text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ __('Actualizar') }} Clase</h4>
                        <a class="btn btn-light btn-sm" href="{{ route('clase.index') }}">{{ __('Volver') }}</a>
                    </div>

                    <div class="bg-white p-4">
                        <form id="actualizar-clase-form" method="POST" action="{{ route('clase.update', $clase->id) }}"
                            role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('clase.form')

                            <div class="mt-4">
                                <button type="submit"
                                    class="btn btn-success admin-btn-create">{{ __('Actualizar') }}</button>
                                <a class="btn btn-secondary admin-btn-toggle"
                                    href="{{ route('clase.index') }}">{{ __('Cancelar') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection