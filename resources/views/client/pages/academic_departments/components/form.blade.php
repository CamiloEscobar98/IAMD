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