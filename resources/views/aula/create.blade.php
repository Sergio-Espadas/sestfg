@extends('layouts.personalizate')

@section('template_title')
{{ __('Crear') }} Aula
@endsection

@section('content')
<section class="py-5 vh-100">
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-admin text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ __('Crear') }} Aula</h4>
                        <a class="btn btn-light btn-sm" href="{{ route('aula.index') }}">{{ __('Volver') }}</a>
                    </div>

                    <div class="bg-white p-4">
                        <form id="crear-aula-form" method="POST" action="{{ route('aula.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-4">
                                <label for="aulaNombre" class="form-label">{{ __('Nombre') }}</label>
                                <input type="text" name="aulaNombre"
                                    class="form-control @error('aulaNombre') is-invalid @enderror"
                                    value="{{ old('aulaNombre', $aula->nombre ?? '') }}" id="aulaNombre"
                                    placeholder="Nombre del aula">
                                @error('aulaNombre')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>

                            <div class="form-group mb-4">
                                <label for="aulaCapacidad" class="form-label">{{ __('Capacidad') }}</label>
                                <input type="text" name="aulaCapacidad"
                                    class="form-control @error('aulaCapacidad') is-invalid @enderror"
                                    value="{{ old('aulaCapacidad', $aula->capacidad ?? '') }}" id="aulaCapacidad"
                                    placeholder="Capacidad del aula">
                                @error('aulaCapacidad')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                            </div>

                            <div class="mt-4">
                                <button type="submit"
                                    class="btn btn-success admin-btn-create">{{ __('Crear') }}</button>
                                <a class="btn btn-secondary admin-btn-toggle"
                                    href="{{ route('aula.index') }}">{{ __('Cancelar') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection