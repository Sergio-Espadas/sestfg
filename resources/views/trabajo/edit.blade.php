@extends('layouts.personalizate')

@section('template_title')
{{ __('Actualizar') }} Trabajo
@endsection

@section('content')
<section class="py-5 vh-100 d-flex align-items-center">
    <div class="container-fluid px-4 h-100">
        <div class="row justify-content-center h-100">
            <div class="col-12">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-admin text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ __('Actualizar') }} Trabajo</h4>
                        <a class="btn btn-light btn-sm" href="{{ route('trabajo.index') }}">{{ __('Volver') }}</a>
                    </div>

                    <div class="bg-white p-4">
                        <form id="editar-trabajo-form" method="POST"
                            action="{{ route('trabajo.update', $trabajo->id) }}" role="form"
                            enctype="multipart/form-data" class="h-100 d-flex flex-column">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('trabajo.form')

                            <div class="mt-4">
                                <button type="submit"
                                    class="btn btn-success admin-btn-create">{{ __('Actualizar') }}</button>
                                <a class="btn btn-secondary admin-btn-toggle"
                                    href="{{ route('trabajo.index') }}">{{ __('Cancelar') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection