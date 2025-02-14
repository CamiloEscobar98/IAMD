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
            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.name') }}</label>
                        </div>
                        <input name="name" class="form-control"
                            placeholder="{{ __('pages.client.users.filters.name') }}"
                            value="{{ getParamValue($params, 'name') }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.email') }}</label>
                        </div>
                        <input type="email" name="email" class="form-control"
                            placeholder="{{ __('pages.client.users.filters.email') }}"
                            value="{{ getParamValue($params, 'email') }}">
                    </div>
                </div>
            </div>
            <div class="btn-group">
                <button class="btn btn-secondary btn-sm">{{ __('buttons.filter') }}</button>
                @if (role_can_permission('users.store'))
                    <a href="{{ route('client.users.create', $client->name) }}"
                        class="btn btn-danger btn-sm ml-2">{{ __('buttons.register') }}</a>
                @endif
            </div>
            <hr>
            <h6 class="font-weight-bold">{{ __('pages.client.users.filters.total') }}<a
                    class="text-secondary">{{ $total }}</a></h6>
        </form>
    </div>
</div>
