<!-- Name -->
<div class="form-group">
    <label>{{ __('inputs.slug') }}:</label>
    <div class="input-group">
        <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
            placeholder="{{ __('inputs.name') }}" value="{{ old('name', $item->name) }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <i class="fas fa-user-cog"></i>
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
    <label>{{ __('inputs.name') }}:</label>
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
<!-- ./Info -->

<div class="row">
    @foreach ($permissionModules as $permissionModule)
        <div class="col-lg-3">
            <div class="form-group mt-3">
                <label>{{ $permissionModule->name }}:</label>
                @foreach ($permissionModule->permissions as $permission)
                    <div class="custom-control custom-checkbox my-1">
                        <input type="checkbox" class="custom-control-input" id="permission_{{ $permission->id }}"
                            name="permissions[]" value="{{ $permission->id }}"
                            {{ optionInArrayIsChecked(old('permissions', $item->permissions), $permission->id) }}>
                        <label class="custom-control-label font-weight-normal"
                            for="permission_{{ $permission->id }}">{{ $permission->info }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
