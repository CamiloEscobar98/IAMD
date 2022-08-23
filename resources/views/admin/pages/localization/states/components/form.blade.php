@if ($editMode)
    <form action="{{ route('admin.localizations.states.update', $item->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="row justify-content-center">
            <img src="{{ asset('assets/images/countries/country_flags.png') }}" class="img-fluid" alt="">
        </div>

        <!-- Country -->
        <div class="input-group mt-3">
            <select class="form-control select2bs4" name="country_id">
                <option value="">{{ __('pages.admin.localizations.states.filters.country_option') }}</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}" {{ twoOptionsIsEqual($item->country_id, $country->id) }}>
                        {{ $country->name }}
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
        <!-- ./Country -->

        <!-- Name -->
        <div class="input-group mt-3">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
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
    <form action="{{ route('admin.localizations.states.store') }}" method="post">
        @csrf

        <div class="row justify-content-center">
            <img src="{{ asset('assets/images/countries/country_flags.png') }}" class="img-fluid" alt="">
        </div>

        <!-- Country -->
        <div class="input-group mt-3">
            <select class="form-control select2bs4" name="country_id">
                <option value="">{{ __('pages.admin.localizations.states.filters.country_option') }}</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}" {{ isSelectedOption(old(), 'country', $country->id) }}>
                        {{ $country->name }}
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
        <!-- ./Country -->

        <!-- Name -->
        <div class="input-group mt-3">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
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
