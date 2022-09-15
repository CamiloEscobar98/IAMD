@if ($editMode)
    <form action="{{ route('admin.creators.assignment_contracts.update', $item->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="row justify-content-center">
            <img src="{{ asset('assets/images/assignment_contracts.gif') }}" class="img-fluid">
        </div>

        <!-- Is Internal or External -->
        <div class="input-group mt-3">
            <select class="form-control" name="is_internal">
                <option value="">{{ __('pages.adminm.creators.assignment_contracts.form.is_internal') }}</option>
                @foreach ($types as $type)
                    <option value="{{ $type['id'] }}" {{ twoOptionsIsEqual($type['id'], $item->is_internal) }}>
                        {{ $type['name'] }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('is_internal')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Is Internal or External -->

        <!-- Name -->
        <div class="input-group mt-3">
            <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
                placeholder="{{ __('inputs.name') }}" value="{{ $item->name }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Name -->

        <div class="form-group mt-3">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.update') }}</button>
        </div>

    </form>
@else
    <form action="{{ route('admin.creators.assignment_contracts.store') }}" method="post">
        @csrf

        <div class="row justify-content-center">
            <img src="{{ asset('assets/images/assignment_contracts.gif') }}" class="img-fluid">
        </div>

        <!-- Is Internal or External -->
        <div class="input-group mt-3">
            <select class="form-control" name="is_internal">
                <option value="">{{ __('pages.admin.creators.assignment_contracts.form.is_internal') }}</option>
                @foreach ($types as $type)
                    <option value="{{ $type['id'] }}" {{ twoOptionsIsEqual($type['id'], old('is_internal')) }}>
                        {{ $type['name'] }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('is_internal')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Is Internal or External -->

        <!-- Address -->
        <div class="input-group mt-3">
            <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
                placeholder="{{ __('inputs.name') }}" value="{{ old('name') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Address -->

        <div class="form-group mt-3">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.save') }}</button>
        </div>

    </form>
@endif
