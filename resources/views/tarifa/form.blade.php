<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2 mb20">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $tarifa?->name) }}" id="name" placeholder="Name">
            <div id="nameError" class="invalid-feedback"></div>
        </div>
        <div class="form-group mb-2 mb20">
            <label for="price" class="form-label">{{ __('Price') }}</label>
            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                value="{{ old('price', $tarifa?->price) }}" id="price" placeholder="Price">
            <div id="priceError" class="invalid-feedback"></div>
        </div>
        <div class="form-group mb-2 mb20">
            <label for="num_clases" class="form-label">{{ __('Num Clases') }}</label>
            <input type="text" name="num_clases" class="form-control @error('num_clases') is-invalid @enderror"
                value="{{ old('num_clases', $tarifa?->num_clases) }}" id="num_clases" placeholder="Num Clases">
            <div id="numClasesError" class="invalid-feedback"></div>
        </div>

    </div>
</div>