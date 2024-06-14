<div class="form-group mb-2 mb20">
    <label for="rolName" class="form-label">{{ __('Nombre') }}</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $role->name) }}" id="rolName" placeholder="Nombre">
    @error('name')
    <div class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </div>
    <div id="rolNombreError" class="invalid-feedback" role="alert"></div>
    @enderror
</div>