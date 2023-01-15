<!-- Name -->
<div class="form-group">
    <label>{{ __('inputs.name') }}:</label>
    <div class="input-group">
        <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
            placeholder="{{ __('inputs.name') }}" value="{{ old('name', $item->name) }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-hands-helping"></span>
            </div>
        </div>
    </div>

    @error('name')
        <small class="text-danger">{!! $message !!}</small>
    @enderror
</div>
<!-- ./Name -->

<!-- Code -->
<div class="form-group mt-3">
    <label>{{ __('inputs.code') }}:</label>
    <div class="input-group">
        <input type="text" name="code" class="form-control {{ isInvalidByError($errors, 'code') }}"
            placeholder="{{ __('inputs.code') }}" value="{{ old('code', $item->code) }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-barcode"></span>
            </div>
        </div>
    </div>

    @error('code')
        <small class="text-danger">{!! $message !!}</small>
    @enderror
</div>
<!-- ./Code -->
