<!-- Intellectual Property Rights Categories -->
<div class="input-group mt-3">
    <select class="form-control select2bs4" name="intellectual_property_right_category_id">
        @foreach ($categories as $categoryItem => $value)
            <option value="{{ $categoryItem }}" {{ twoOptionsIsEqual($item->intellectual_property_right_category_id, $categoryItem) }}>
                {{ $value }}
            </option>
        @endforeach
    </select>
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-star"> {{ __('inputs.intellectual_property_rights_category') }}</span>
        </div>
    </div>
</div>

@error('intellectual_property_right_category_id')
    <small class="text-danger">{{ $message }}</small>
@enderror
<!-- ./Intellectual Property Rights Categories  -->

<!-- Name -->
<div class="input-group mt-3">
    <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
        placeholder="{{ __('inputs.name') }}" value="{{ old('name', $item->name) }}">
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-square"> {{ __('inputs.name') }}</span>
        </div>
    </div>
</div>

@error('name')
    <small class="text-danger">{{ $message }}</small>
@enderror
<!-- ./Name -->

<div class="form-group mt-3">
    <button class="btn btn-danger btn-sm">{{ __('buttons.update') }}</button>
</div>
