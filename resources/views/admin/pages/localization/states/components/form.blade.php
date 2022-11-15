<!-- Country -->
<div class="form-group">
    <label>{{ __('inputs.country_id') }}:</label>
    <div class="input-group">
        <select class="form-control select2bs4" name="country_id">
            @foreach ($countries as $country => $value)
                <option value="{{ $country }}"
                    {{ twoOptionsIsEqual(old('country_id', getParamObject($item->country, 'id')), $country) }}>
                    {{ $value }}
                </option>
            @endforeach
        </select>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-flag"></span>
            </div>
        </div>
    </div>

    @error('country_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<!-- ./Country -->

<!-- Name -->
<div class="form-group mt-3">
    <label>{{ __('inputs.name') }}:</label>
    <div class="input-group">
        <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
            placeholder="{{ __('inputs.name') }}" value="{{ old('name', $item->name) }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-building"></span>
            </div>
        </div>
    </div>

    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<!-- ./Name -->
