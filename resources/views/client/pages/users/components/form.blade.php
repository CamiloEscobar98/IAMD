@if ($editMode)
    <form action="{{ getClientRoute('client.users.update', [$item->id]) }}" method="post">
        @csrf
        @method('PUT')

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

        <!-- Email -->
        <div class="input-group mt-3">
            <input type="email" name="email" class="form-control {{ isInvalidByError($errors, 'email') }}"
                placeholder="{{ __('inputs.email') }}" value="{{ $item->email }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Email -->

        <!-- Password -->
        <div class="input-group mt-3">
            <input type="password" name="password" class="form-control {{ isInvalidByError($errors, 'password') }}"
                placeholder="{{ __('inputs.password') }}" value="{{ old('password') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('password')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Password -->

        <!-- Repeat Password -->
        <div class="input-group mt-3">
            <input type="password" name="repeat_password"
                class="form-control {{ isInvalidByError($errors, 'repeat_password') }}"
                placeholder="{{ __('inputs.repeat_password') }}" value="{{ $item->repeat_password }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('repeat_password')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Repeat Password -->

        <div class="form-group mt-3">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.update') }}</button>
        </div>

    </form>
@else
    <form action="{{ route('client.users.store', $client->name) }}" method="post">
        @csrf

        <!-- Name -->
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
        <!-- ./Name -->

        <!-- Email -->
        <div class="input-group mt-3">
            <input type="email" name="email" class="form-control {{ isInvalidByError($errors, 'email') }}"
                placeholder="{{ __('inputs.email') }}" value="{{ old('email') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Email -->

        <!-- Password -->
        <div class="input-group mt-3">
            <input type="password" name="password" class="form-control {{ isInvalidByError($errors, 'password') }}"
                placeholder="{{ __('inputs.password') }}" value="{{ old('password') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('password')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Password -->

        <!-- Repeat Password -->
        <div class="input-group mt-3">
            <input type="password" name="repeat_password"
                class="form-control {{ isInvalidByError($errors, 'repeat_password') }}"
                placeholder="{{ __('inputs.repeat_password') }}" value="{{ old('repeat_password') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('repeat_password')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Repeat Password -->

        <div class="form-group mt-3 mb-0">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.save') }}</button>
        </div>

    </form>
@endif
