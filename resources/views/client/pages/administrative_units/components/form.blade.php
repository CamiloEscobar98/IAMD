<!-- Name -->
<div class="form-group">
    <label>Nombre:</label>
    <div class="input-group">
        <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
            placeholder="{{ __('inputs.name') }}" value="{{ old('name', $item->name) }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <i class="fas fa-university"></i>
            </div>
        </div>
    </div>
</div>

@error('name')
    <small class="text-danger">{{ $message }}</small>
@enderror
<!-- ./Name -->

<!-- Info -->
<div class="form-group mt-3">
    <label>Descripción:</label>
    <div class="input-group">
        <textarea class="form-control @error('info') is-invalid @enderror" name="info" id="info" cols="30"
            rows="4">{{ old('info', $item->info) }}</textarea>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-info"></span>
            </div>
        </div>
    </div>
</div>

@error('info')
    <small class="text-danger">{{ $message }}</small>
@enderror
<!-- ./Info -->
