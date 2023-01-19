<!-- Research Unit -->
<div class="form-group mt-3">
    <label>Unidades de Investigación:</label>
    <div class="input-group">
        <select name="research_unit_id[]" id="research_unit_id" class="form-control select2bs4" multiple>
            @foreach ($administrativeUnits as $administrativeUnitItem)
                <optgroup label="{{ $administrativeUnitItem->name }}">
                    @foreach ($administrativeUnitItem->research_units->pluck('name', 'id') as $researchUnitItemId => $value)
                        <option value="{{ $researchUnitItemId }}"
                            {{ optionInArray(old() ?: $item->research_units, 'research_unit_id', $researchUnitItemId) }}>
                            {{ $value }}</option>
                    @endforeach
                </optgroup>
            @endforeach
        </select>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-microscope"></span>
            </div>
        </div>
    </div>

    @error('research_unit_id')
        <small class="text-danger">{!! $message !!}</small>
    @enderror
</div>
<!-- ./Research Unit -->

<!-- Director -->
<div class="form-group mt-3">
    <label>Director:</label>
    <div class="input-group">
        <select name="director_id" class="form-control select2bs4 {{ isInvalidByError($errors, 'director_id') }}">
            @foreach ($directors as $directorId => $value)
                <option value="{{ $directorId }}"
                    {{ twoOptionsIsEqual(old('director_id', $item->director_id), $directorId) }}>
                    {{ $value }}</option>
            @endforeach
        </select>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user-tie"></span>
            </div>
        </div>
    </div>

    @error('director_id')
        <small class="text-danger">{!! $message !!}</small>
    @enderror
</div>
<!-- ./Director -->

<!-- Name -->
<div class="form-group mt-3">
    <label>Nombre:</label>
    <div class="input-group">
        <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
            placeholder="{{ __('inputs.name') }}" value="{{ old('name', $item->name) }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user-tie"></span>
            </div>
        </div>
    </div>

    @error('name')
        <small class="text-danger">{!! $message !!}</small>
    @enderror
</div>
<!-- ./Name -->

<!-- Description -->
<div class="form-group mt-3">
    <label>Descripción:</label>
    <div class="input-group">
        <textarea class="form-control {{ isInvalidByError($errors, 'description') }}" name="description" id="description"
            cols="30" rows="3">{{ old('description', $item->description) }}</textarea>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-info"></span>
            </div>
        </div>
    </div>

    @error('description')
        <small class="text-danger">{!! $message !!}</small>
    @enderror
</div>
<!-- ./Description -->

<hr>

<!-- Financing Types -->
<div class="form-group mt-3">
    <label>{{ __('inputs.financing_type_id') }}:</label>
    <div class="input-group">
        <select name="financing_type_id[]" id="financing_type_id"
            class="form-control select2bs4 {{ isInvalidByError($errors, 'financing_type_id') }}" multiple>
            @foreach ($financingTypes as $financingTypeId => $value)
                <option value="{{ $financingTypeId }}"
                    {{ optionInArray(old() ?: $item->project_financings, 'financing_type_id', $financingTypeId) }}>
                    {{ $value }}</option>
            @endforeach
        </select>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-dollar-sign"></span>
            </div>
        </div>
    </div>

    @error('financing_type_id')
        <small class="text-danger">{!! $message !!}</small>
    @enderror
</div>
<!-- ./Financing Types -->

<!-- Project Contract Types -->
<div class="form-group mt-3">
    <label>{{ __('inputs.project_contract_type_id') }}:</label>
    <div class="input-group">
        <select name="project_contract_type_id" id="project_contract_type_id"
            class="form-control select2bs4 {{ isInvalidByError($errors, 'project_contract_type_id') }}">
            @foreach ($projectContractTypes as $projectContractTypeId => $value)
                <option value="{{ $projectContractTypeId }}"
                    {{ twoOptionsIsEqual(old('project_contract_type_id', getParamObject($item, 'project_contract_type_id')), $projectContractTypeId) }}>
                    {{ $value }}</option>
            @endforeach
        </select>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-book-reader"></span>
            </div>
        </div>
    </div>

    @error('project_contract_type_id')
        <small class="text-danger">{!! $message !!}</small>
    @enderror
</div>
<!-- ./Project Contract Types -->

<!-- Contract -->
<div class="form-group mt-3">
    <label>Nombre del Contrato:</label>
    <div class="input-group">
        <input type="text" name="contract" class="form-control {{ isInvalidByError($errors, 'contract') }}"
            placeholder="{{ __('inputs.contract') }}"
            value="{{ old('contract', getParamObject($item, 'contract')) }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-book"></span>
            </div>
        </div>
    </div>

    @error('contract')
        <small class="text-danger">{!! $message !!}</small>
    @enderror
</div>
<!-- ./Contract -->

<!-- Date -->
<div class="form-group mt-3">
    <label>Fecha del Contrato:</label>

    <div class="input-group">
        <input type="date" name="date" class="form-control {{ isInvalidByError($errors, 'date') }}"
            placeholder="{{ __('inputs.date') }}"
            value="{{ old('date', getParamObject($item, 'date')) }}">
    </div>

    @error('date')
        <small class="text-danger">{!! $message !!}</small>
    @enderror
</div>
<!-- ./Date -->
