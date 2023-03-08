<div class="row justify-content-center">
    <div class="col-12">
        <form method="get" data-client="{{ $client->name }}" id="form">
            <div class="row justify-content-between">
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
                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.name') }}</label>
                        </div>
                        <input type="text" name="name" class="form-control"
                            placeholder="{{ __('pages.client.projects.filters.name') }}"
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
                        <select name="administrative_unit_id" id="administrative_unit_id"
                            class="form-control select2bs4 administrative_units" onchange="changeAdministrativeUnit()">
                            @foreach ($administrativeUnits as $administrativeUnit => $value)
                                <option value="{{ $administrativeUnit }}"
                                    {{ optionIsSelected($params, 'administrative_unit_id', $administrativeUnit) }}>
                                    {{ $value }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <!-- Research Units -->
                <div class="col-lg-5">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.research_units') }}</label>
                        </div>
                        <select name="research_unit_id[]" id="research_unit_id"
                            class="form-control select2bs4 research_units" multiple>
                            @foreach ($researchUnits as $researchUnit => $value)
                                <option value="{{ $researchUnit }}"
                                    {{ optionInArray($params, 'research_unit_id', $researchUnit) }}>
                                    {{ $value }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <!-- ./Research Units -->

                <!-- Directors Creator -->
                <div class="col-lg-3">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.directors') }}</label>
                        </div>
                        <select name="director_id[]" id="director_id" class="form-control directors" multiple>
                            @foreach ($directors as $directorId => $value)
                                <option value="{{ $directorId }}"
                                    {{ optionInArray($params, 'director_id', $directorId) }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- ./Directors Creator -->
            </div>

            <div class="btn-group">
                <button class="btn btn-secondary btn-sm">{{ __('buttons.filter') }}</button>
                @can('projects.store')
                    <a href="{{ route('client.projects.create', $client->name) }}"
                        class="btn btn-danger btn-sm ml-2">{{ __('buttons.register') }}</a>
                @endcan
            </div>
            <hr>
            <h6 class="font-weight-bold">{{ __('pages.client.projects.filters.total') }}<a
                    class="text-secondary">{{ $total }}</a></h6>
        </form>
    </div>
</div>
