<div class="row padding-1 p-1">
    <div class="col-md-12">
        <div class="form-group mb-2 mb20">
            <label for="aulaNombre" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="aulaNombre" class="form-control @error('aulaNombre') is-invalid @enderror"
                value="{{ old('aulaNombre', $aula?->nombre) }}" id="aulaNombreForm" placeholder="Nombre">
            {!! $errors->first('aulaNombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>
            ')
            !!}
            <div id="aulaNombreError" class="invalid-feedback" role="alert"></div>
        </div>
        <div class="form-group mb-2 mb20">
            <label for="aulaCapacidad" class="form-label">{{ __('Capacidad') }}</label>
            <input type="text" name="aulaCapacidad" class="form-control @error('aulaCapacidad') is-invalid @enderror"
                value="{{ old('aulaCapacidad', $aula?->capacidad) }}" id="aulaCapacidad" placeholder="Capacidad">
            {!! $errors->first('aulaCapacidad', '<div class="invalid-feedback" role="alert"><strong>:message</strong>
            </div>
            ')
            !!}
            <div id="aulaCapacidadError" class="invalid-feedback" role="alert"></div>
        </div>
    </div>
</div>