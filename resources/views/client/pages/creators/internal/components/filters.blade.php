<div class="row justify-content-center">
    <div class="col-12">
        <form method="get">
            <div class="row justify-content-between">
                <div class="col-lg-3">
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
                <div class="col-lg-3">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.date_from') }}</label>
                        </div>
                        <input name="date_from" type="date" class="form-control"
                            value="{{ getParamValue($params, 'date_from') }}">
                    </div>
                </div>
                <div class="col-lg-3">
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
                            <label class="input-group-text">{{ __('filters.name') }}</label>
                        </div>
                        <input type="text" name="name" class="form-control"
                            placeholder="{{ __('pages.client.creators.internal.filters.name') }}"
                            value="{{ getParamValue($params, 'name') }}">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">

                <!-- Linkage Types -->
                <div class="col-lg-4">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.linkage_types') }}</label>
                        </div>
                        <select name="linkage_type_id" class="form-control select2bs4">
                            <option value="">{{ __('pages.client.creators.internal.filters.linkage_types') }}
                            </option>
                            @foreach ($linkageTypes as $linkageType)
                                <option value="{{ $linkageType->id }}"
                                    {{ optionIsSelected($params, 'linkage_type_id', $linkageType->id) }}>
                                    {{ $linkageType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- ./Linkage Types -->

                <!-- Assignment Contracts -->
                <div class="col-lg-4">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.assignment_contracts') }}</label>
                        </div>
                        <select name="assignment_contract_id" class="form-control select2bs4">
                            <option value="">
                                {{ __('pages.client.creators.internal.filters.assignment_contracts') }}
                            </option>
                            @foreach ($assignmentContracts as $assignmentContract)
                                <option value="{{ $assignmentContract->id }}"
                                    {{ optionIsSelected($params, 'assignment_contract_id', $assignmentContract->id) }}>
                                    {{ $assignmentContract->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- ./Assignment Contracts -->

                <!-- Document -->
                <div class="col-lg-3">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.document') }}</label>
                        </div>
                        <input type="text" name="document" class="form-control"
                            placeholder="{{ __('pages.client.creators.internal.filters.document') }}"
                            value="{{ getParamValue($params, 'document') }}">
                    </div>
                </div>
                <!-- ./Document -->

            </div>
            <div class="btn-group">
                <button class="btn btn-secondary btn-sm">{{ __('buttons.filter') }}</button>
                <a href="{{ route('client.creators.internal.create', $client->name) }}"
                    class="btn btn-danger btn-sm ml-2">{{ __('buttons.register') }}</a>
            </div>
            <hr>
            <h6 class="font-weight-bold">{{ __('pages.client.creators.internal.filters.total') }}<a
                    class="text-secondary">{{ $total }}</a></h6>
        </form>
    </div>
</div>
