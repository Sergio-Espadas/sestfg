@extends('layouts.personalizate')

@section('template_title')
{{ __('Crear Rol') }}
@endsection

@section('content')
<section class="py-5 vh-100">
    <div class="container-fluid px-4">
        <div class="row justify-content-start">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-admin text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ __('Crear Rol') }}</h4>
                        <a class="btn btn-light btn-sm" href="{{ route('role.index') }}">{{ __('Volver') }}</a>
                    </div>

                    <div class="bg-white p-4">
                        <form id="crear-rol-form" method="POST" action="{{ route('role.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row padding-1 p-1">
                                <div class="col-md-12">
                                    <div class="form-group mb-2 mb20">
                                        <label for="rolName" class="form-label">{{ __('Nombre') }}</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" id="rolName" placeholder="Nombre">
                                        @error('name')
                                        <div class="invalid-feedback" id="rolNameError">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit"
                                    class="btn btn-success admin-btn-create">{{ __('Crear') }}</button>
                                <a class="btn btn-secondary admin-btn-toggle"
                                    href="{{ route('role.index') }}">{{ __('Cancelar') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection