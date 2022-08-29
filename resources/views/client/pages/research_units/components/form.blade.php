@if ($editMode)
    <form action="{{ getClientRoute('client.research_units.update', [$item->id]) }}" method="post">
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

        <!-- Info -->
        <div class="input-group mt-3">
            <textarea class="form-control @error('info') is-invalid @enderror" name="info" id="info" cols="30"
                rows="10">{{ $item->info }}</textarea>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('info')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Info -->

        <div class="form-group mt-3">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.update') }}</button>
        </div>

    </form>
@else
    <form action="{{ route('client.research_units.store', $client->name) }}" method="post">
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

        <!-- Code -->
        <div class="input-group mt-3">
            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                placeholder="{{ __('inputs.code') }}" value="{{ old('code') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('code')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Code -->

        <!-- Administrative Unit -->
        <div class="input-group mt-3">
            <select name="administrative_unit_id"
                class="form-control select2bs4 @error('administrative_unit_id') is-invalid @enderror">
                <option value="-1">{{ __('inputs.administrative_unit_id') }}
                </option>
                @foreach ($administrativeUnits as $administrativeUnit)
                    <option value="{{ $administrativeUnit->id }}"
                        {{ twoOptionsIsEqual(old('administrative_unit_id'), $administrativeUnit->id) }}>
                        {{ $administrativeUnit->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('administrative_unit_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Administrative Unit -->

        <!-- Research Unit Category -->
        <div class="input-group mt-3">
            <select name="research_unit_category_id"
                class="form-control select2bs4 @error('research_unit_category_id') is-invalid @enderror">
                <option value="-1">{{ __('inputs.research_unit_category_id') }}
                </option>
                @foreach ($researchUnitCategories as $researchUnitCategory)
                    <option value="{{ $researchUnitCategory->id }}"
                        {{ twoOptionsIsEqual(old('research_unit_category_id'), $researchUnitCategory->id) }}>
                        {{ $researchUnitCategory->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('research_unit_category_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Research Unit Category -->

        <!-- Info -->
        <div class="input-group mt-3">
            <textarea class="form-control @error('info') is-invalid @enderror" name="info" id="info" cols="30"
                rows="10">{{ old('info') }}</textarea>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-info"></span>
                </div>
            </div>
        </div>

        @error('info')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Info -->

        <div class="form-group mt-3 mb-0">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.save') }}</button>
        </div>

    </form>
@endif
