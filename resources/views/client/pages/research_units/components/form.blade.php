@if ($editMode)
    <form action="{{ getClientRoute('client.research_units.update', [$item->id]) }}" method="post">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="input-group mt-3">
            <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
                placeholder="{{ __('inputs.name') }}" value="{{ $item->name }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-file-alt"></span>
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
                placeholder="{{ __('inputs.code') }}" value="{{ $item->code }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-barcode"></span>
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
                        {{ twoOptionsIsEqual($item->administrative_unit_id, $administrativeUnit->id) }}>
                        {{ $administrativeUnit->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-university"></span>
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
                        {{ twoOptionsIsEqual($item->research_unit_category_id, $researchUnitCategory->id) }}>
                        {{ $researchUnitCategory->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-microscope"></span>
                </div>
            </div>
        </div>

        @error('research_unit_category_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Research Unit Category -->

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
                    <span class="fas fa-user-tie"></span>
                </div>
            </div>
        </div>

        @error('director_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Director -->

        <!-- Inventory Manager -->
        <div class="input-group mt-3">
            <select name="inventory_manager_id"
                class="form-control select2bs4 @error('inventory_manager_id') is-invalid @enderror">
                <option value="-1">{{ __('inputs.inventory_manager_id') }}
                </option>
                @foreach ($creators as $inventoryManager)
                    <option value="{{ $inventoryManager->id }}"
                        {{ twoOptionsIsEqual($item->inventory_manager_id, $inventoryManager->id) }}>
                        {{ $inventoryManager->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>

        @error('inventory_manager_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Inventory Manager -->

        <!-- Info -->
        <div class="input-group mt-3">
            <textarea class="form-control {{ isInvalidByError($errors, 'description') }}" name="description" id="description"
                cols="30" rows="10">{{ $item->description }}</textarea>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-sticky-note"></span>
                </div>
            </div>
        </div>

        @error('description')
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

        <!-- Inventory Manager -->
        <div class="input-group mt-3">
            <select name="inventory_manager_id"
                class="form-control select2bs4 @error('inventory_manager_id') is-invalid @enderror">
                <option value="-1">{{ __('inputs.inventory_manager_id') }}
                </option>
                @foreach ($creators as $inventoryManager)
                    <option value="{{ $inventoryManager->id }}"
                        {{ twoOptionsIsEqual(old('inventory_manager_id'), $inventoryManager->id) }}>
                        {{ $inventoryManager->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('inventory_manager_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Inventory Manager -->

        <!-- Description -->
        <div class="input-group mt-3">
            <textarea class="form-control {{ isInvalidByError($errors, 'description') }}" name="description" id="description"
                cols="30" rows="10">{{ old('description') }}</textarea>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-info"></span>
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
