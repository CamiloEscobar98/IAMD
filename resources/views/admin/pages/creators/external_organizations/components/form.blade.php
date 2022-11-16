<!-- Nit -->
<div class="form-group mt-3">
    <label>{{ __('inputs.nit') }}:</label>
    <div class="input-group">
        <input type="text" name="nit" class="form-control @error('nit') is-invalid @enderror"
            placeholder="{{ __('inputs.nit') }}" value="{{ old('nit', $item->nit) }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="far fa-id-card"></span>
            </div>
        </div>
    </div>

    @error('nit')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<!-- ./Nit -->

<!-- Name -->
<div class="form-group mt-3">
    <label>{{ __('inputs.name') }}:</label>
    <div class="input-group">
        <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
            placeholder="{{ __('inputs.name') }}" value="{{ old('name', $item->name) }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-industry"></span>
            </div>
        </div>
    </div>

    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<!-- ./Name -->

<!-- Email -->
<div class="form-group mt-3">
    <label>{{ __('inputs.email') }}:</label>
    <div class="input-group">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
            placeholder="{{ __('inputs.email') }}" value="{{ old('email', $item->email) }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-at"></span>
            </div>
        </div>
    </div>

    @error('email')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<!-- ./Email -->

<!-- Telephone -->
<div class="form-group mt-3">
    <label>{{ __('inputs.telephone') }}:</label>
    <div class="input-group">
        <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror"
            placeholder="{{ __('inputs.telephone') }}" value="{{ old('telephone', $item->telephone) }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-phone"></span>
            </div>
        </div>
    </div>

    @error('telephone')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<!-- ./Telephone -->

<!-- Address -->
<div class="form-group mt-3">
    <label>{{ __('inputs.address') }}:</label>
    <div class="input-group">
        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
            placeholder="{{ __('inputs.address') }}" value="{{ old('address', $item->address) }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-city"></span>
            </div>
        </div>
    </div>

    @error('address')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<!-- ./Address -->
