@extends('layouts.personalizate')

@section('template_title')
{{ $role->name ?? __('Mostrar') . " " . __('Rol') }}
@endsection

@section('content')
<section class="py-5 vh-100">
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-admin text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ __('Mostrar') }} Rol</h4>
                        <a class="btn btn-light btn-sm" href="{{ route('role.index') }}">{{ __('Volver') }}</a>
                    </div>

                    <div class="card-body bg-white p-4">
                        <div class="row padding-1 p-1">
                            <div class="col-md-12">
                                <div class="form-group mb-2 mb-20">
                                    <strong class="text-secondary">{{ __('Nombre') }}:</strong>
                                    <p class="form-control-plaintext">{{ $role->name }}</p>
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