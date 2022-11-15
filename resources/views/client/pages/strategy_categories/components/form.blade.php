<!-- Name -->
<div class="form-group mt-3">
    <label>{{ __('inputs.name') }}:</label>
    <div class="input-group">
        <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
            placeholder="{{ __('inputs.name') }}" value="{{ old('name', $item->name) }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-star"></span>
            </div>
        </div>
    </div>

    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<!-- ./Name -->

<!-- Description -->
<div class="form-group mt-3">
    <label>{{ __('inputs.info') }}:</label>
    <div class="input-group">
        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
            cols="30" rows="4">{{ old('description', $item->description) }}</textarea>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-info"></span>
            </div>
        </div>
    </div>

    @error('description')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<!-- ./Description -->
