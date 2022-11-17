<!-- Is Internal or External -->
<div class="form-group mt-3">
    <label>{{ __('pages.admin.creators.assignment_contracts.form.is_internal') }}:</label>
    <div class="input-group">
        <select class="form-control" name="is_internal">
            @foreach ($types as $type => $value)
                <option value="{{ $type }}"
                    {{ twoOptionsIsEqual(old('is_internal', $item->is_internal), $type) }}>
                    {{ $value }}</option>
            @endforeach
        </select>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-users"></span>
            </div>
        </div>
    </div>

    @error('is_internal')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<!-- ./Is Internal or External -->

<!-- Address -->
<div class="form-group mt-3">
    <label>{{ __('inputs.name') }}:</label>
    <div class="input-group">
        <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
            placeholder="{{ __('inputs.name') }}" value="{{ old('name', $item->name) }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user-tie"></span>
            </div>
        </div>
    </div>

    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<!-- ./Address -->
