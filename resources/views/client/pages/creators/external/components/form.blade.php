@if ($editMode)
    <form action="{{ getClientRoute('client.creators.external.update', [$item->creator_id]) }}" method="post">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="input-group mt-3">
            <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
                placeholder="{{ __('inputs.name') }}" value="{{ $item->creator->name }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>

        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Name -->

        <!-- Phone -->
        <div class="input-group mt-3">
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                placeholder="{{ __('inputs.phone') }}" value="{{ $item->creator->phone }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-phone"></span>
                </div>
            </div>
        </div>

        @error('phone')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Phone -->

        <!-- Document -->
        <div class="input-group mt-3">
            <input type="text" name="document" class="form-control @error('document') is-invalid @enderror"
                placeholder="{{ __('inputs.document') }}" value="{{ $item->creator->document->document }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-id-card	"></span>
                </div>
            </div>
        </div>

        @error('document')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Document -->

        <!-- Document Type -->
        <div class="input-group mt-3">
            <select name="document_type_id"
                class="form-control select2bs4 @error('document_type_id') is-invalid @enderror">
                <option value="-1" class="font-weight-bold" disabled>{{ __('inputs.document_type_id') }}
                </option>
                @foreach ($documentTypes as $documentType)
                    <option value="{{ $documentType->id }}"
                        {{ twoOptionsIsEqual($item->creator->document->document_type_id, $documentType->id) }}>
                        {{ $documentType->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-address-card"></span>
                </div>
            </div>
        </div>

        @error('document_type_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Document Type -->

        <!--Expedition Place -->

        <!-- Countries -->
        <div class="input-group mt-3">
            <select name="country_id" id="country_id" class="form-control select2bs4" onchange="changeCountry()">
                @foreach ($countries as $countryItem)
                    <option value="{{ $countryItem->id }}" {{ twoOptionsIsEqual($country->id, $countryItem->id) }}>
                        {{ $countryItem->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>
        <!-- ./Countries -->

        <!-- States -->
        <div class="input-group mt-3">
            <select name="state_id" id="state_id" class="form-control select2bs4" onchange="changeState()">
                @foreach ($states as $stateItem)
                    <option value="{{ $stateItem->id }}" {{ twoOptionsIsEqual($state->id, $stateItem->id) }}>
                        {{ $stateItem->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>
        <!-- ./States -->

        <!-- Cities -->
        <div class="input-group mt-3">
            <select name="expedition_place_id" id="city_id" class="form-control select2bs4">
                @foreach ($cities as $cityItem)
                    <option value="{{ $cityItem->id }}"
                        {{ twoOptionsIsEqual($item->creator->document->expedition_place_id, $cityItem->id) }}>
                        {{ $cityItem->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>

        @error('expedition_place_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Cities -->

        <!-- ./Expedition Place -->

        <!-- Email -->
        <div class="input-group mt-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="{{ __('inputs.email') }}" value="{{ $item->creator->email }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>

        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Email -->

        <!-- External Organization -->
        <div class="input-group mt-3">
            <select name="external_organization_id"
                class="form-control select2bs4 @error('external_organization_id') is-invalid @enderror">
                <option value="-1" class="font-weight-bold" disabled>{{ __('inputs.external_organization_id') }}
                </option>
                @foreach ($externalOrganizations as $externalOrganization)
                    <option value="{{ $externalOrganization->id }}"
                        {{ twoOptionsIsEqual($item->external_organization_id, $externalOrganization->id) }}>
                        {{ $externalOrganization->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-industry"></span>
                </div>
            </div>
        </div>

        @error('external_organization_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./External Organization -->

        <!-- Assignment Contract -->
        <div class="input-group mt-3">
            <select name="assignment_contract_id"
                class="form-control select2bs4 @error('assignment_contract_id') is-invalid @enderror">
                <option value="-1">{{ __('inputs.assignment_contract_id') }}
                </option>
                @foreach ($assignmentContracts as $assignmentContract)
                    <option value="{{ $assignmentContract->id }}"
                        {{ twoOptionsIsEqual($item->assignment_contract_id, $assignmentContract->id) }}>
                        {{ $assignmentContract->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user-tie"></span>
                </div>
            </div>
        </div>

        @error('assignment_contract_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Assignment Contract -->

        <div class="form-group mt-3">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.update') }}</button>
        </div>

    </form>
@else
    <form action="{{ route('client.creators.external.store', $client->name) }}" method="post">
        @csrf

        <!-- Name -->
        <div class="input-group mt-3">
            <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
                placeholder="{{ __('inputs.name') }}" value="{{ old('name') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>

        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Name -->

        <!-- Phone -->
        <div class="input-group mt-3">
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                placeholder="{{ __('inputs.phone') }}" value="{{ old('phone') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-phone"></span>
                </div>
            </div>
        </div>

        @error('phone')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Phone -->

        <!-- Document -->
        <div class="input-group mt-3">
            <input type="text" name="document" class="form-control @error('document') is-invalid @enderror"
                placeholder="{{ __('inputs.document') }}" value="{{ old('document') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-id-card	"></span>
                </div>
            </div>
        </div>

        @error('document')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Document -->

        <!-- Document Type -->
        <div class="input-group mt-3">
            <select name="document_type_id"
                class="form-control select2bs4 @error('document_type_id') is-invalid @enderror">
                <option value="-1">{{ __('inputs.document_type_id') }}
                </option>
                @foreach ($documentTypes as $documentType)
                    <option value="{{ $documentType->id }}"
                        {{ twoOptionsIsEqual(old('document_type_id'), $documentType->id) }}>
                        {{ $documentType->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-address-card"></span>
                </div>
            </div>
        </div>

        @error('document_type_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Document Type -->

        <!--Expedition Place -->

        <!-- Countries -->
        <div class="input-group mt-3">
            <select name="country_id" id="country_id" class="form-control select2bs4" onchange="changeCountry()">
                @foreach ($countries as $countryItem)
                    <option value="{{ $countryItem->id }}" {{ twoOptionsIsEqual($country->id, $countryItem->id) }}>
                        {{ $countryItem->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-flag"></span>
                </div>
            </div>
        </div>
        <!-- ./Countries -->

        <!-- States -->
        <div class="input-group mt-3">
            <select name="state_id" id="state_id" class="form-control select2bs4" onchange="changeState()">
                @foreach ($states as $stateItem)
                    <option value="{{ $stateItem->id }}" {{ twoOptionsIsEqual($state->id, $stateItem->id) }}>
                        {{ $stateItem->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-building"></span>
                </div>
            </div>
        </div>
        <!-- ./States -->

        <!-- Cities -->
        <div class="input-group mt-3">
            <select name="expedition_place_id" id="city_id" class="form-control select2bs4">
                @foreach ($cities as $cityItem)
                    <option value="{{ $cityItem->id }}"
                        {{ twoOptionsIsEqual(old('expedition_place_id'), $cityItem->id) }}>
                        {{ $cityItem->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-city"></span>
                </div>
            </div>
        </div>

        @error('expedition_place_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Cities -->

        <!-- ./Expedition Place -->

        <!-- Email -->
        <div class="input-group mt-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="{{ __('inputs.email') }}" value="{{ old('email') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>

        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Email -->

        <!-- External Organization -->
        <div class="input-group mt-3">
            <select name="external_organization_id"
                class="form-control select2bs4 @error('external_organization_id') is-invalid @enderror">
                <option value="-1">{{ __('inputs.external_organization_id') }}
                </option>
                @foreach ($externalOrganizations as $externalOrganization)
                    <option value="{{ $externalOrganization->id }}"
                        {{ twoOptionsIsEqual(old('external_organization_id'), $externalOrganization->id) }}>
                        {{ $externalOrganization->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-industry"></span>
                </div>
            </div>
        </div>

        @error('external_organization_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./External Organization -->

        <!-- Assignment Contract -->
        <div class="input-group mt-3">
            <select name="assignment_contract_id"
                class="form-control select2bs4 @error('assignment_contract_id') is-invalid @enderror">
                <option value="-1">{{ __('inputs.assignment_contract_id') }}
                </option>
                @foreach ($assignmentContracts as $assignmentContract)
                    <option value="{{ $assignmentContract->id }}"
                        {{ twoOptionsIsEqual(old('assignment_contract_id'), $assignmentContract->id) }}>
                        {{ $assignmentContract->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user-tie"></span>
                </div>
            </div>
        </div>

        @error('assignment_contract_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Assignment Contract -->

        <div class="form-group mt-3 mb-0">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.save') }}</button>
        </div>

    </form>
@endif
