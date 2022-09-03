@if ($editMode)
    <form action="{{ getClientRoute('client.projects.update', [$item->id]) }}" method="post">
        @csrf
        @method('PUT')

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

        <!-- Research Unit -->
        <div class="input-group mt-3">
            <select name="research_unit_id"
                class="form-control select2bs4 @error('research_unit_id') is-invalid @enderror">
                <option value="-1">{{ __('inputs.research_unit_id') }}
                </option>
                @foreach ($administrativeUnits as $administrativeUnit)
                    <optgroup label="{{ $administrativeUnit->name }}">
                        @foreach ($administrativeUnit->research_units as $researchUnit)
                            <option value="{{ $researchUnit->id }}"
                                {{ twoOptionsIsEqual($item->research_unit_id, $researchUnit->id) }}>
                                {{ $researchUnit->name }}</option>
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

        @error('research_unit_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Research Unit -->

        <!-- Director -->
        <div class="input-group mt-3">
            <select name="director_id" class="form-control select2bs4 @error('director_id') is-invalid @enderror">
                <option value="-1">{{ __('inputs.director_id') }}
                </option>
                @foreach ($creators as $director)
                    <option value="{{ $director->id }}" {{ twoOptionsIsEqual($item->director_id, $director->id) }}>
                        {{ $director->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('director_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Director -->

        <!-- Description -->
        <div class="input-group mt-3">
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                cols="30" rows="10">{{ $item->description }}</textarea>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-description"></span>
                </div>
            </div>
        </div>

        @error('description')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Description -->

        <div class="form-group mt-3">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.update') }}</button>
        </div>

    </form>
@else
    <form action="{{ route('client.projects.store', $client->name) }}" method="post">
        @csrf

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

        <!-- Research Unit -->
        <div class="input-group mt-3">
            <select name="research_unit_id"
                class="form-control select2bs4 @error('research_unit_id') is-invalid @enderror">
                <option value="-1">{{ __('inputs.research_unit_id') }}
                </option>
                @foreach ($administrativeUnits as $administrativeUnit)
                    <optgroup label="{{ $administrativeUnit->name }}">
                        @foreach ($administrativeUnit->research_units as $researchUnit)
                            <option value="{{ $researchUnit->id }}"
                                {{ twoOptionsIsEqual(old('research_unit_id'), $researchUnit->id) }}>
                                {{ $researchUnit->name }}</option>
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

        @error('research_unit_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Research Unit -->

        <!-- Director -->
        <div class="input-group mt-3">
            <select name="director_id" class="form-control select2bs4 @error('director_id') is-invalid @enderror">
                <option value="-1">{{ __('inputs.director_id') }}
                </option>
                @foreach ($creators as $director)
                    <option value="{{ $director->id }}" {{ twoOptionsIsEqual(old('director_id'), $director->id) }}>
                        {{ $director->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('director_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Director -->

        <!-- Description -->
        <div class="input-group mt-3">
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                cols="30" rows="10">{{ old('description') }}</textarea>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-description"></span>
                </div>
            </div>
        </div>

        @error('description')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Description -->

        <div class="form-group mt-3 mb-0">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.save') }}</button>
        </div>

    </form>
@endif
