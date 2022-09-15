@if ($editMode)
    <form action="{{ route('admin.localizations.cities.update', $item->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="row justify-content-center">
            <img src="{{ asset('assets/images/countries/country_flags.png') }}" class="img-fluid" alt="">
        </div>

        <!-- State -->
        <div class="input-group mt-3">
            <select name="state_id" class="form-control select2bs4">
                <option value="">
                    {{ __('pages.admin.localizations.cities.filters.state_option') }}
                </option>
                @foreach ($countries as $country)
                    <optgroup label=" Pais: {{ $country->name }}">
                        @foreach ($country->states as $state)
                            <option value="{{ $state->id }}" {{ twoOptionsIsEqual($item->state->id, $state->id) }}>
                                {{ $state->name }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('state_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./State -->

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
    <form action="{{ route('admin.localizations.cities.store') }}" method="post">
        @csrf

        <div class="row justify-content-center">
            <img src="{{ asset('assets/images/countries/country_flags.png') }}" class="img-fluid" alt="">
        </div>

        <!-- State -->
        <div class="input-group mt-3">
            <select name="state_id" class="form-control select2bs4">
                <option value="">
                    {{ __('pages.admin.localizations.cities.filters.state_option') }}
                </option>
                @foreach ($countries as $country)
                    <optgroup label=" Pais: {{ $country->name }}">
                        @foreach ($country->states as $state)
                            <option value="{{ $state->id }}" {{ isSelectedOption(old(), 'state_id', $state->id) }}>
                                {{ $state->name }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('state_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./State -->

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

        <div class="form-group mt-3">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.save') }}</button>
        </div>

    </form>
@endif
