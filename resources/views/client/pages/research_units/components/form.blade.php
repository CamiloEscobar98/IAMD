<!-- Name -->
<div class="form-group mt-3">
    <label>Nombre:</label>
    <div class="input-group">
        <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
            placeholder="{{ __('inputs.name') }}" value="{{ old('name', $item->name) }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <i class="fas fa-file-alt"></i>
            </div>
        </div>
    </div>

    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<!-- ./Name -->

<!-- Code -->
<div class="form-group mt-3">
    <label>Código:</label>
    <div class="input-group">
        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
            placeholder="{{ __('inputs.code') }}" value="{{ old('code', $item->code) }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <i class="fas fa-barcode"></i>
            </div>
        </div>
    </div>

    @error('code')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<!-- ./Code -->

<!-- Administrative Unit -->
<div class="form-group mt-3">
    <label>Facultad:</label>
    <div class="input-group">
        <select name="administrative_unit_id"
            class="form-control select2bs4 @error('administrative_unit_id') is-invalid @enderror">
            @foreach ($administrativeUnits as $administrativeUnit => $value)
                <option value="{{ $administrativeUnit }}"
                    {{ twoOptionsIsEqual(old('administrative_unit_id', $item->administrative_unit_id), $administrativeUnit) }}>
                    {{ $value }}</option>
            @endforeach
        </select>
        <div class="input-group-append">
            <div class="input-group-text">
                <i class="fas fa-university"></i>
            </div>
        </div>
    </div>

    @error('administrative_unit_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<!-- ./Administrative Unit -->

<!-- Research Unit Category -->
<div class="form-group mt-3">
    <label>Unidad de Investigación:</label>
    <div class="input-group">
        <select name="research_unit_category_id"
            class="form-control select2bs4 @error('research_unit_category_id') is-invalid @enderror">
            @foreach ($researchUnitCategories as $researchUnitCategory => $value)
                <option value="{{ $researchUnitCategory }}"
                    {{ twoOptionsIsEqual(old('research_unit_category_id', $item->research_unit_category_id), $researchUnitCategory) }}>
                    {{ $value }}</option>
            @endforeach
        </select>
        <div class="input-group-append">
            <div class="input-group-text">
                <i class="fas fa-microscope"></i>
            </div>
        </div>
    </div>

    @error('research_unit_category_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<!-- ./Research Unit Category -->

<!-- Director -->
<div class="form-group mt-3">
    <label>Director:</label>
    <div class="input-group">
        <select name="director_id" class="form-control select2bs4 @error('director_id') is-invalid @enderror">
            @foreach ($directors as $director => $value)
                <option value="{{ $director }}"
                    {{ twoOptionsIsEqual(old('director_id', $item->director_id), $director) }}>
                    {{ $value }}</option>
            @endforeach
        </select>
        <div class="input-group-append">
            <div class="input-group-text">
                <i class="fas fa-user-tie"></i>
            </div>
        </div>
    </div>

    @error('director_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<!-- ./Director -->

<!-- Inventory Manager -->
<div class="form-group mt-3">
    <label>Administrador de Inventario:</label>
    <div class="input-group">
        <select name="inventory_manager_id"
            class="form-control select2bs4 @error('inventory_manager_id') is-invalid @enderror">
            @foreach ($inventoryManagers as $inventoryManager => $value)
                <option value="{{ $inventoryManager }}"
                    {{ twoOptionsIsEqual(old('inventory_manager_id', $item->inventory_manager_id), $inventoryManager) }}>
                    {{ $value }}</option>
            @endforeach
        </select>
        <div class="input-group-append">
            <div class="input-group-text">
                <i class="fas fa-user"></i>
            </div>
        </div>
    </div>

    @error('inventory_manager_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<!-- ./Inventory Manager -->

<!-- Description -->
<div class="form-group mt-3">
    <label>Descripción:</label>
    <div class="input-group">
        <textarea class="form-control {{ isInvalidByError($errors, 'description') }}" name="description" id="description"
            cols="30" rows="4">{{ old('description', $item->description) }}</textarea>
        <div class="input-group-append">
            <div class="input-group-text">
                <i class="fas fa-info"></i>
            </div>
        </div>
    </div>

    @error('description')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<!-- ./Description -->
