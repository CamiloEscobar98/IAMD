<div class="row justify-content-center">
    <div class="col-12">
        <form method="get">
            <div class="row justify-content-between">
                <div class="col-lg-2">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.order_by') }}</label>
                        </div>
                        <select class="custom-select" name="order_by">
                            <option value="1" {{ isSelectedOption($params, 'order_by', '1') }}>A-Z</option>
                            <option value="2" {{ isSelectedOption($params, 'order_by', '2') }}>Z-A</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.date_from') }}</label>
                        </div>
                        <input name="date_from" type="date" class="form-control"
                            value="{{ getParamValue($params, 'date_from') }}">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.date_to') }}</label>
                        </div>
                        <input name="date_to" type="date" class="form-control"
                            value="{{ getParamValue($params, 'date_to') }}">
                    </div>
                </div>
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
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.administrative_units') }}</label>
                        </div>
                        <select name="administrative_unit_id" class="form-control select2bs4">
                            <option value="">{{ __('pages.client.research_units.filters.administrative_units') }}
                            </option>
                            @foreach ($administrativeUnits as $administrativeUnit)
                                <option value="{{ $administrativeUnit->id }}"
                                    {{ optionIsSelected($params, 'administrative_unit_id', $administrativeUnit->id) }}>
                                    {{ $administrativeUnit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.research_unit_categories') }}</label>
                        </div>
                        <select name="research_unit_category_id" class="form-control select2bs4">
                            <option value="">
                                {{ __('pages.client.research_units.filters.research_unit_categories') }}
                            </option>
                            @foreach ($researchUnitCategories as $researchUnitCategory)
                                <option value="{{ $researchUnitCategory->id }}"
                                    {{ optionIsSelected($params, 'research_unit_category_id', $researchUnitCategory->id) }}>
                                    {{ $researchUnitCategory->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="btn-group">
                <button class="btn btn-secondary btn-sm">{{ __('buttons.filter') }}</button>
                <a href="{{ route('client.research_units.create', $client->name) }}"
                    class="btn btn-dark btn-sm ml-2">{{ __('buttons.register') }}</a>
            </div>
            <hr>
            <h6 class="font-weight-bold">{{ __('pages.client.research_units.filters.total') }}<a
                    class="text-secondary">{{ $total }}</a></h6>
        </form>
    </div>
</div>
