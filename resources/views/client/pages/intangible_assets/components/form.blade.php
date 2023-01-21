<!-- Project -->
<div class="form-group mt-3">
    <label>Proyecto:</label>
    <div class="input-group">
        <select name="project_id" id="project_id" class="form-control select2bs4 @error('project_id') is-invalid @enderror"
            onchange="changeProjectSelect()">
            @foreach ($projects as $projectId => $value)
                <option value="{{ $projectId }}"
                    {{ twoOptionsIsEqual(old('project_id', $item->project_id), $projectId) }}>
                    {{ $value }}</option>
            @endforeach
        </select>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-chalkboard-teacher"></span>
            </div>
        </div>
    </div>

    @error('project_id')
        <small class="text-danger">{!! $message !!}</small>
    @enderror
</div>
<!-- ./Project -->

<!-- Research Units -->
<div class="form-group mt-3">
    <label>Unidades Investigativas:</label>
    <div class="input-group">
        <select name="research_unit_id[]" id="research_unit_id"
            class="form-control select2bs4 @error('research_unit_id') is-invalid @enderror" multiple>
            @foreach ($researchUnits as $researchUnitId => $value)
                <option value="{{ $researchUnitId }}"
                    {{ optionInArray(old() ?: $item->research_units, 'research_unit_id', $researchUnitId) }}>
                    {{ $value }}</option>
            @endforeach
        </select>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-chalkboard-teacher"></span>
            </div>
        </div>
    </div>

    @error('research_unit_id')
        <small class="text-danger">{!! $message !!}</small>
    @enderror
</div>
<!-- ./Research Units -->

<!-- Name -->
<div class="form-group mt-3">
    <label>{{ __('inputs.name') }}:</label>
    <div class="input-group">
        <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
            placeholder="{{ __('inputs.name') }}" value="{{ old('name', $item->name) }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-archive"></span>
            </div>
        </div>
    </div>

    @error('name')
        <small class="text-danger">{!! $message !!}</small>
    @enderror
</div>
<!-- ./Name -->

<!-- Date -->
<div class="form-group mt-3">
    <label>{{ __('inputs.intangible_asset_date') }}:</label>
    <div class="input-group">
        <input type="date" name="date" class="form-control {{ isInvalidByError($errors, 'date') }}"
            placeholder="{{ __('inputs.date') }}" value="{{ old('date', $item->date) }}">
    </div>

    @error('date')
        <small class="text-danger">{!! $message !!}</small>
    @enderror
</div>
<!-- ./Date -->

<hr>

<!-- Localization -->
<div class="form-group mt-3">
    <label>{{ __('inputs.intangible_asset_localization') }}:</label>
    <div class="input-group">
        <input type="text" name="localization" class="form-control {{ isInvalidByError($errors, 'localization') }}"
            placeholder="{{ __('inputs.intangible_asset_localization') }}"
            value="{{ old('localization', getParamObject($item->intangible_asset_localization, 'localization')) }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-globe-americas"></span>
            </div>
        </div>
    </div>

    @error('localization')
        <small class="text-danger">{!! $message !!}</small>
    @enderror
</div>
<!-- ./Localization -->

<!-- Code Localization -->
<div class="form-group mt-3">
    <label>{{ __('inputs.intangible_asset_code_localization') }} (Opcional):</label>
    <div class="input-group">
        <input type="text" name="localization_code"
            class="form-control {{ isInvalidByError($errors, 'localization_code') }}"
            placeholder="{{ __('inputs.intangible_asset_code_localization') }}"
            value="{{ old('localization_code', getParamObject($item->intangible_asset_localization, 'code')) }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-barcode"></span>
            </div>
        </div>
    </div>

    @error('localization_code')
        <small class="text-danger">{!! $message !!}</small>
    @enderror
</div>
<!-- ./Code Localization -->
