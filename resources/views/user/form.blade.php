<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user?->name) }}" id="name" placeholder="Name">
            @error('name')
            <div id="userError" class="invalid-feedback" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group mb-2 mb20">
            <label for="apellido_1" class="form-label">{{ __('Apellido 1') }}</label>
            <input type="text" name="apellido_1" class="form-control @error('apellido_1') is-invalid @enderror"
                value="{{ old('apellido_1', $user?->apellido_1) }}" id="apellido_1" placeholder="Apellido 1">
            @error('apellido_1')
            <div id="userError" class="invalid-feedback" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group mb-2 mb20">
            <label for="apellido_2" class="form-label">{{ __('Apellido 2') }}</label>
            <input type="text" name="apellido_2" class="form-control @error('apellido_2') is-invalid @enderror"
                value="{{ old('apellido_2', $user?->apellido_2) }}" id="apellido_2" placeholder="Apellido 2">
            @error('apellido_2')
            <div id="userError" class="invalid-feedback" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group mb-2 mb20">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user?->email) }}" id="email" placeholder="Email">
            @error('email')
            <div id="userError" class="invalid-feedback" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group mb-2 mb20">
            <label for="dni" class="form-label">{{ __('Dni') }}</label>
            <input type="text" name="dni" class="form-control @error('dni') is-invalid @enderror"
                value="{{ old('dni', $user?->dni) }}" id="dni" placeholder="Dni">
            @error('dni')
            <div id="userError" class="invalid-feedback" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group mb-2 mb20">
            <label for="id_tarifa" class="form-label">{{ __('Tarifa') }}</label>
            <select name="id_tarifa" class="form-select @error('id_tarifa') is-invalid @enderror" id="id_tarifa">
                <option value="">Seleccionar Tarifa</option>
                @foreach($tarifas as $tarifa)
                <option value="{{ $tarifa->id }}"
                    {{ old('id_tarifa', $user->id_tarifa ?? '') == $tarifa->id ? 'selected' : '' }}>{{ $tarifa->name }}
                </option>
                @endforeach
            </select>
            @error('id_tarifa')
            <div id="userError" class="invalid-feedback" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group mb-2 mb20">
            <label for="id_rol" class="form-label">{{ __('Rol') }}</label>
            <select name="id_rol" class="form-select @error('id_rol') is-invalid @enderror" id="id_rol">
                <option value="">Seleccionar Rol</option>
                @foreach($roles as $rol)
                <option value="{{ $rol->id }}" {{ old('id_rol', $user->id_rol ?? '') == $rol->id ? 'selected' : '' }}>
                    {{ $rol->name }}</option>
                @endforeach
            </select>
            @error('id_rol')
            <div id="userError" class="invalid-feedback" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>