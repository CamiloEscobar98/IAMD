@if ($editMode)
    <form action="{{ getClientRoute('client.creators.internal.update', [$item->id]) }}" method="post">
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
    <form action="{{ route('client.creators.internal.store', $client->name) }}" method="post">
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
        <div class="input-group mt-3">
            <select name="expedition_place_id" class="form-control select2bs4">
                <option value="">
                    {{ __('inputs.expedition_place_id') }}
                </option>
                @foreach ($states as $state)
                    <optgroup label="{{ $state->country->name }}: {{ $state->name }}">
                        @foreach ($state->cities as $city)
                            <option value="{{ $city->id }}"
                                {{ twoOptionsIsEqual(old('expedition_place_id'), $city->id) }}>
                                {{ $city->name }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-address-card"></span>
                </div>
            </div>
        </div>

        @error('expedition_place_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
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

        <!-- Linkage Type -->
        <div class="input-group mt-3">
            <select name="linkage_type_id"
                class="form-control select2bs4 @error('linkage_type_id') is-invalid @enderror">
                <option value="-1">{{ __('inputs.linkage_type_id') }}
                </option>
                @foreach ($linkageTypes as $linkageType)
                    <option value="{{ $linkageType->id }}"
                        {{ twoOptionsIsEqual(old('linkage_type_id'), $linkageType->id) }}>
                        {{ $linkageType->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user-friends"></span>
                </div>
            </div>
        </div>

        @error('linkage_type_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Linkage Type -->

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
