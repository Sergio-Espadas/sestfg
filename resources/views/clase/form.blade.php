<div class="form-group mb-2 mb20">
    <label for="id_aula" class="form-label">{{ __('Aula') }}</label>
    <select name="id_aula" class="form-control @error('id_aula') is-invalid @enderror">
        <option value="">Seleccione Aula</option>
        @foreach($aulas as $aula)
        <option value="{{ $aula->id }}"
            {{ old('id_aula', isset($clase) ? $clase->id_aula : '') == $aula->id ? 'selected' : '' }}>
            {{ $aula->nombre }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback"></div>
</div>

<div class="form-group mb-2 mb20">
    <label for="id_trabajo" class="form-label">{{ __('Trabajo') }}</label>
    <select name="id_trabajo" class="form-control @error('id_trabajo') is-invalid @enderror">
        <option value="">Seleccione Trabajo</option>
        @foreach($trabajos as $trabajo)
        <option value="{{ $trabajo->id }}"
            {{ old('id_trabajo', isset($clase) ? $clase->id_trabajo : '') == $trabajo->id ? 'selected' : '' }}>
            {{ $trabajo->nombre }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback"></div>
</div>

<div class="form-group mb-2 mb20">
    <label for="fecha" class="form-label">{{ __('Fecha') }}</label>
    <input type="date" name="fecha" class="form-control @error('fecha') is-invalid @enderror"
        value="{{ old('fecha', isset($clase) ? $clase->fecha : '') }}" id="fecha" placeholder="Fecha">
    <div class="invalid-feedback"></div>
</div>

<div class="form-group mb-2 mb20">
    <label for="hora" class="form-label">{{ __('Hora') }}</label>
    <input type="time" name="hora" class="form-control @error('hora') is-invalid @enderror"
        value="{{ old('hora', isset($clase) ? $clase->hora : '') }}" id="hora" placeholder="Hora">
    <div class="invalid-feedback"></div>
</div>