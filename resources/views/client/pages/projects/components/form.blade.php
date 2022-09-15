@if ($editMode)
    <form action="{{ getClientRoute('client.projects.update', [$item->id]) }}"
        method="post"data-client="{{ $client->name }}" id="form">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="input-group mt-3">
            <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
                placeholder="{{ __('inputs.name') }}" value="{{ $item->name }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-file-alt"> {{ __('inputs.project_name') }}</span>
                </div>
            </div>
        </div>

        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Name -->

        <!-- Administrative Unit -->
        <div class="input-group mt-3">
            <select name="administrative_unit_id" id="administrative_unit_id" class="form-control select2bs4"
                onchange="changeAdministrativeUnit()">

                @foreach ($administrativeUnits as $administrativeUnitItem)
                    <option value="{{ $administrativeUnitItem->id }}"
                        {{ twoOptionsIsEqual($administrativeUnit->id, $administrativeUnitItem->id) }}>
                        {{ $administrativeUnitItem->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-university"> {{ __('inputs.administrative_unit_id') }}</span>
                </div>
            </div>
        </div>
        <!-- ./Administrative Unit -->

        <!-- Research Unit -->
        <div class="input-group mt-3">
            <select name="research_unit_id" id="research_unit_id" class="form-control select2bs4">

                @foreach ($researchUnits as $researchUnitItem)
                    <option value="{{ $researchUnitItem->id }}"
                        {{ twoOptionsIsEqual($researchUnit->id, $researchUnitItem->id) }}>
                        {{ $researchUnitItem->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-microscope nav-icon"> {{ __('inputs.research_unit_id') }}</span>
                </div>
            </div>
        </div>
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
                    <span class="fas fa-user-tie nav-icon"> {{ __('inputs.director_id') }}</span>
                </div>
            </div>
        </div>

        @error('director_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Director -->

        <!-- Description -->
        <div class="input-group mt-3">
            <textarea class="form-control {{ isInvalidByError($errors, 'description') }}" name="description" id="description"
                cols="30" rows="10">{{ $item->description }}</textarea>
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

        <hr>

        <!-- Financing Types -->
        <div class="input-group mt-3">
            <select name="financing_type_id"
                class="form-control select2bs4 {{ isInvalidByError($errors, 'financing_type_id') }}">
                <option value="-1">{{ __('inputs.financing_type_id') }}
                </option>
                @foreach ($financingTypes as $financingType)
                    <option value="{{ $financingType->id }}"
                        {{ twoOptionsIsEqual($item->project_financing->financing_type_id, $financingType->id) }}>
                        {{ $financingType->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user-tie nav-icon"> {{ __('inputs.financing_type_id') }}</span>
                </div>
            </div>
        </div>

        @error('financing_type_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Financing Types -->

        <!-- Project Contract Types -->
        <div class="input-group mt-3">
            <select name="project_contract_type_id"
                class="form-control select2bs4 {{ isInvalidByError($errors, 'project_contract_type_id') }}">
                <option value="-1">{{ __('inputs.project_contract_type_id') }}
                </option>
                @foreach ($projectContractTypes as $projectContractType)
                    <option value="{{ $projectContractType->id }}"
                        {{ twoOptionsIsEqual($item->project_financing->project_contract_type_id, $projectContractType->id) }}>
                        {{ $projectContractType->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-briefcase nav-icon"> {{ __('inputs.project_contract_type_id') }}</span>
                </div>
            </div>
        </div>

        @error('project_contract_type_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Project Contract Types -->

        <!-- Contract -->
        <div class="input-group mt-3">
            <input type="text" name="contract" class="form-control {{ isInvalidByError($errors, 'contract') }}"
                placeholder="{{ __('inputs.contract') }}" value="{{ $item->project_financing->contract }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user-tie nav-icon"> {{ __('inputs.contract') }}</span>
                </div>
            </div>
        </div>

        @error('contract')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Contract -->

        <!-- Date -->
        <div class="input-group mt-3">
            <input type="date" name="date" class="form-control {{ isInvalidByError($errors, 'date') }}"
                placeholder="{{ __('inputs.date') }}" value="{{ $item->project_financing->date }}">
        </div>

        @error('date')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Date -->

        <div class="form-group mt-3">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.update') }}</button>
        </div>

    </form>
@else
    <form action="{{ route('client.projects.store', $client->name) }}" method="post"
        data-client="{{ $client->name }}" id="form">
        @csrf

        <!-- Administrative Unit -->
        <div class="input-group mt-3">
            <select name="administrative_unit_id" id="administrative_unit_id" class="form-control select2bs4"
                onchange="changeAdministrativeUnit()">

                @foreach ($administrativeUnits as $administrativeUnitItem)
                    <option value="{{ $administrativeUnitItem->id }}"
                        {{ twoOptionsIsEqual($administrativeUnit->id, $administrativeUnitItem->id) }}>
                        {{ $administrativeUnitItem->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-university"></span>
                </div>
            </div>
        </div>
        <!-- ./Administrative Unit -->

        <!-- Research Unit -->
        <div class="input-group mt-3">
            <select name="research_unit_id" id="research_unit_id" class="form-control select2bs4">

                @foreach ($researchUnits as $researchUnitItem)
                    <option value="{{ $researchUnitItem->id }}"
                        {{ twoOptionsIsEqual($researchUnit->id, $researchUnitItem->id) }}>
                        {{ $researchUnitItem->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-microscope"></span>
                </div>
            </div>
        </div>

        @error('research_unit_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Research Unit -->

        <!-- Director -->
        <div class="input-group mt-3">
            <select name="director_id"
                class="form-control select2bs4 {{ isInvalidByError($errors, 'director_id') }}">
                <option value="-1">{{ __('inputs.director_id') }}
                </option>
                @foreach ($creators as $director)
                    <option value="{{ $director->id }}" {{ twoOptionsIsEqual(old('director_id'), $director->id) }}>
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

        <!-- Name -->
        <div class="input-group mt-3">
            <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
                placeholder="{{ __('inputs.name') }}" value="{{ old('name') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user-tie"></span>
                </div>
            </div>
        </div>

        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Name -->

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

        <hr>

        <!-- Financing Types -->
        <div class="input-group mt-3">
            <select name="financing_type_id"
                class="form-control select2bs4 {{ isInvalidByError($errors, 'financing_type_id') }}">
                <option value="-1">{{ __('inputs.financing_type_id') }}
                </option>
                @foreach ($financingTypes as $financingType)
                    <option value="{{ $financingType->id }}"
                        {{ twoOptionsIsEqual(old('financing_type_id'), $financingType->id) }}>
                        {{ $financingType->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user-tie"></span>
                </div>
            </div>
        </div>

        @error('financing_type_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Financing Types -->

        <!-- Project Contract Types -->
        <div class="input-group mt-3">
            <select name="project_contract_type_id"
                class="form-control select2bs4 {{ isInvalidByError($errors, 'project_contract_type_id') }}">
                <option value="-1">{{ __('inputs.project_contract_type_id') }}
                </option>
                @foreach ($projectContractTypes as $projectContractType)
                    <option value="{{ $projectContractType->id }}"
                        {{ twoOptionsIsEqual(old('project_contract_type_id'), $projectContractType->id) }}>
                        {{ $projectContractType->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user-tie"></span>
                </div>
            </div>
        </div>

        @error('project_contract_type_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Project Contract Types -->

        <!-- Contract -->
        <div class="input-group mt-3">
            <input type="text" name="contract" class="form-control {{ isInvalidByError($errors, 'contract') }}"
                placeholder="{{ __('inputs.contract') }}" value="{{ old('contract') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user-tie"></span>
                </div>
            </div>
        </div>

        @error('contract')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Contract -->

        <!-- Date -->
        <div class="input-group mt-3">
            <input type="date" name="date" class="form-control {{ isInvalidByError($errors, 'date') }}"
                placeholder="{{ __('inputs.date') }}" value="{{ old('date') }}">
        </div>

        @error('date')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Date -->


        <div class="form-group mt-3 mb-0">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.save') }}</button>
        </div>

    </form>
@endif
