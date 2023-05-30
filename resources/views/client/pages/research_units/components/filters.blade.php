<div class="row justify-content-center">
    <div class="col-12">
        <form method="get">
            <div class="row justify-content-between">
                <!-- Order By Filter -->
                <div class="col-lg-2">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.order_by') }}</label>
                        </div>
                        <select class="custom-select" name="order_by">
                            <option value="1" {{ optionIsSelected($params, 'order_by', 1) }}>A-Z</option>
                            <option value="2" {{ optionIsSelected($params, 'order_by', 2) }}>Z-A</option>
                        </select>
                    </div>
                </div>
                <!-- Order By Filter -->

                <!-- Date From Filter -->
                <div class="col-lg-2">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.date_from') }}</label>
                        </div>
                        <input name="date_from" type="date" class="form-control"
                            value="{{ getParamValue($params, 'date_from') }}">
                    </div>
                </div>
                <!-- ./Date From Filter -->

                <!-- Date To Filter -->
                <div class="col-lg-2">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.date_to') }}</label>
                        </div>
                        <input name="date_to" type="date" class="form-control"
                            value="{{ getParamValue($params, 'date_to') }}">
                    </div>
                </div>
                <!-- Date To Filter -->

                <!-- Code Filter -->
                <div class="col-lg-3">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.code') }}</label>
                        </div>
                        <input type="text" name="name" class="form-control"
                            placeholder="{{ __('pages.client.research_units.filters.code') }}"
                            value="{{ getParamValue($params, 'name') }}">
                    </div>
                </div>
                <!-- ./Code Filter -->

                <!-- Name Filter -->
                <div class="col-lg-3">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.name') }}</label>
                        </div>
                        <input type="text" name="name" class="form-control"
                            placeholder="{{ __('pages.client.research_units.filters.name') }}"
                            value="{{ getParamValue($params, 'name') }}">
                    </div>
                </div>
                <!-- ./Name Filter -->
            </div>
            <div class="row justify-content-center">
                <!-- Administrative Units Filter -->
                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.administrative_units') }}</label>
                        </div>
                        <select name="administrative_unit_id[]" class="form-control select2bs4 administrative_units"
                            multiple>
                            @foreach ($administrativeUnits as $administrativeUnitId => $value)
                                <option value="{{ $administrativeUnitId }}"
                                    {{ optionInArray($params, 'administrative_unit_id', $administrativeUnitId) }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- ./Administrative Units Filter -->

                <!-- Research Unit Categories Filter -->
                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.research_unit_categories') }}</label>
                        </div>
                        <select name="research_unit_category_id[]"
                            class="form-control select2bs4 research_unit_categories" multiple>
                            @foreach ($researchUnitCategories as $researchUnitCategoryId => $value)
                                <option value="{{ $researchUnitCategoryId }}"
                                    {{ optionInArray($params, 'research_unit_category_id', $researchUnitCategoryId) }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- ./Research Unit Categories Filter -->
            </div>
            <div class="row justify-content-center">

                <!-- Directors Creator -->
                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.directors') }}</label>
                        </div>
                        <select name="director_id[]" class="form-control select2bs4 directors" multiple>
                            @foreach ($directors as $directorId => $value)
                                <option value="{{ $directorId }}"
                                    {{ optionInArray($params, 'director_id', $directorId) }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- ./Directors Creator -->

                <!-- Inventory Manager Creator -->
                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.inventory_managers') }}</label>
                        </div>
                        <select name="inventory_manager_id[]" class="form-control select2bs4 inventory_managers"
                            multiple>
                            @foreach ($inventoryManagers as $inventoryManagerId => $value)
                                <option value="{{ $inventoryManagerId }}"
                                    {{ optionInArray($params, 'inventory_manager_id', $inventoryManagerId) }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- ./Inventory Manager Creator -->
            </div>

            <div class="btn-group">
                <button class="btn btn-secondary btn-sm">{{ __('buttons.filter') }}</button>
                @if (role_can_permission('research_units.store'))
                    <a href="{{ route('client.research_units.create', $client->name) }}"
                        class="btn btn-danger btn-sm ml-2">{{ __('buttons.register') }}</a>
                @endif
            </div>
            <hr>
            <h6 class="font-weight-bold">{{ __('pages.client.research_units.filters.total') }}<a
                    class="text-secondary">{{ $total }}</a></h6>
        </form>
    </div>
</div>
