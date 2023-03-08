<div class="row justify-content-center">
    <div class="col-12">
        <form method="get" id="form" data-client="{{ $client->name }}">
            <div class="row justify-content-center">
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
                            placeholder="{{ __('pages.client.intangible_assets.filters.name') }}"
                            value="{{ getParamValue($params, 'name') }}">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <!-- Projects -->
                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.projects') }}</label>
                        </div>
                        <select name="project_id[]" id="project_id" class="form-control select2bs4" multiple>
                            @foreach ($projects as $projectId => $value)
                                <option value="{{ $projectId }}"
                                    {{ optionInArray($params, 'project_id', $projectId) }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- ./Projects -->

                <!-- States -->
                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.intangible_assets_state') }}</label>
                        </div>
                        <select name="intangible_asset_state_id[]" id="intangible_asset_state_id"
                            class="form-control select2bs4" multiple>
                            @foreach ($states as $stateId => $value)
                                <option value="{{ $stateId }}"
                                    {{ optionInArray($params, 'intangible_asset_state_id', $stateId) }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- ./States -->
            </div>

            <div class="btn-group">
                <button class="btn btn-secondary btn-sm">{{ __('buttons.filter') }}</button>
                @can('intangible_assets.store')
                    <a href="{{ route('client.intangible_assets.create', $client->name) }}"
                        class="btn btn-danger btn-sm ml-2">{{ __('buttons.register') }}</a>
                @endcan
            </div>
            <hr>
            <h6 class="font-weight-bold">{{ __('pages.client.intangible_assets.filters.total') }}<a
                    class="text-secondary">{{ $total }}</a></h6>
        </form>
    </div>
</div>
