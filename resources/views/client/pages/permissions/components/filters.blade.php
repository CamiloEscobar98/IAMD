<div class="row justify-content-center">
    <div class="col-12">
        <form method="get">
            <div class="row justify-content-between">
                <div class="col-lg-4">
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
                <div class="col-lg-4">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.date_from') }}</label>
                        </div>
                        <input name="date_from" type="date" class="form-control"
                            value="{{ getParamValue($params, 'date_from') }}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.date_to') }}</label>
                        </div>
                        <input name="date_to" type="date" class="form-control"
                            value="{{ getParamValue($params, 'date_to') }}">
                    </div>
                </div>
            </div>
            <div class="row mt">
                <div class="col-lg-6 mb-3">
                    <!-- Modules -->
                    <div class="input-group">
                        <select class="permission_modules" name="permission_module_id[]" multiple
                            class="form-control select2bs4 @error('permission_module_id') is-invalid @enderror">
                            @foreach ($modules as $module => $value)
                                <option value="{{ $module }}"
                                    {{ optionInArray($params, 'permission_module_id', $module) }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-box"></span>
                            </div>
                        </div>
                    </div>
                    <!-- ./Modules -->
                </div>
                <div class="col-lg-6 mb-3">
                    <div class="input-group">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.name') }}</label>
                        </div>
                        <input type="text" name="name" class="form-control"
                            placeholder="{{ __('pages.client.permissions.filters.name') }}"
                            value="{{ getParamValue($params, 'name') }}">
                    </div>
                </div>
            </div>
            <div class="btn-group">
                <button class="btn btn-secondary btn-sm">{{ __('buttons.filter') }}</button>
                @can('permissions.store')
                    <a href="{{ route('client.permissions.create', $client->name) }}"
                        class="btn btn-danger btn-sm ml-2">{{ __('buttons.register') }}</a>
                @endcan
            </div>
            <hr>
            <h6 class="font-weight-bold">{{ __('pages.client.permissions.filters.total') }}<a
                    class="text-secondary">{{ $total }}</a></h6>
        </form>
    </div>
</div>
