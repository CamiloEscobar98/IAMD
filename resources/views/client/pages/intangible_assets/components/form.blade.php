@if ($editMode)
    <form action="{{ getClientRoute('client.intangible_assets.update', [$item->id]) }}" method="post"
        data-client="{{ $client->name }}" id="form">
        @csrf
        @method('PUT')

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
            <select name="research_unit_id" id="research_unit_id" class="form-control select2bs4"
                onchange="changeResearchUnit()">

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
        <!-- ./Research Unit -->

        <!-- Project -->
        <div class="input-group mt-3">
            <select name="project_id" id="project_id"
                class="form-control select2bs4 @error('project_id') is-invalid @enderror">

                @foreach ($projects as $projectItem)
                    <option value="{{ $projectItem->id }}" {{ twoOptionsIsEqual($project->id, $projectItem->id) }}>
                        {{ $projectItem->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-chalkboard-teacher"></span>
                </div>
            </div>
        </div>

        @error('project_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Project -->


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

        <!-- Button Save -->
        <div class="form-group mt-3 mb-0">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.update') }}</button>
        </div>
        <!-- ./Button Save -->

    </form>
@else
    <form action="{{ route('client.intangible_assets.store', $client->name) }}" method="post"
        data-client="{{ $client->name }}" id="form">
        @csrf

        <!-- Administrative Unit -->
        <div class="input-group mt-3">
            <select name="administrative_unit_id" id="administrative_unit_id" class="form-control select2bs4"
                onchange="changeAdministrativeUnit()">

                @foreach ($administrativeUnits as $administrativeUnit)
                    <option value="{{ $administrativeUnit->id }}"
                        {{ optionIsSelected(old(), 'administrative_unit_id', $administrativeUnit->id) }}>
                        {{ $administrativeUnit->name }}</option>
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
            <select name="research_unit_id" id="research_unit_id" class="form-control select2bs4"
                onchange="changeResearchUnit()">

                @foreach ($researchUnits as $researchUnit)
                    <option value="{{ $researchUnit->id }}"
                        {{ optionIsSelected(old(), 'research_unit_id', $researchUnit->id) }}>
                        {{ $researchUnit->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-microscope"></span>
                </div>
            </div>
        </div>
        <!-- ./Research Unit -->

        <!-- Project -->
        <div class="input-group mt-3">
            <select name="project_id" id="project_id"
                class="form-control select2bs4 @error('project_id') is-invalid @enderror">

                @foreach ($projects as $project)
                    <option value="{{ $project->id }}" {{ optionIsSelected(old(), 'project_id', $project->id) }}>
                        {{ $project->name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-chalkboard-teacher"></span>
                </div>
            </div>
        </div>

        @error('project_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Project -->

        <!-- Name -->
        <div class="input-group mt-3">
            <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
                placeholder="{{ __('inputs.name') }}" value="{{ old('name') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-archive"></span>
                </div>
            </div>
        </div>

        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <!-- ./Name -->

        <!-- Button Save -->
        <div class="form-group mt-3 mb-0">
            <button class="btn btn-secondary btn-sm">{{ __('buttons.save') }}</button>
        </div>
        <!-- ./Button Save -->

    </form>
@endif
