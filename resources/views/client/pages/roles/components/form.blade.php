<!-- Name -->
<div class="form-group mt-3">
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
    <label>Información:</label>
    <div class="input-group">
        <input type="text" name="info" class="form-control {{ isInvalidByError($errors, 'info') }}"
            placeholder="{{ __('inputs.info') }}" value="{{ old('info', $item->info) }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <i class="fas fa-info"></i>
            </div>
        </div>
    </div>

</div>
@error('info')
    <small class="text-danger">{{ $message }}</small>
@enderror
