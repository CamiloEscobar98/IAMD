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
                                placeholder="{{ __('pages.admin.intellectual_property_rights.products.filters.name') }}"
                                value="{{ getParamValue($params, 'name') }}">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mb-4">
                    <div class="col-lg-6">
                        <!-- Intellectual Property Rights Categories -->
                        <div class="input-group">
                            <div class="input-group-append">
                                <label class="input-group-text">
                                    {{ __('filters.intellectual_property_rights_categories') }}
                                </label>
                            </div>
                            <select class="form-control select2bs4" name="intellectual_property_right_category_id"
                                id="intellectual_property_right_category_id"
                                onchange="changeIntellectualPropertyRightCategory()">
                                @foreach ($categories as $categoryItem => $value)
                                    <option value="{{ $categoryItem }}"
                                        {{ twoOptionsIsEqual(old('intellectual_property_right_category_id'), $categoryItem) }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- ./Intellectual Property Rights Categories  -->
                    </div>
                    <div class="col-lg-6">
                        <!-- Intellectual Property Rights Subcategories -->
                        <div class="input-group">
                            <div class="input-group-append">
                                <label class="input-group-text">
                                    {{ __('filters.intellectual_property_rights_subcategories') }}
                                </label>
                            </div>
                            <select class="form-control select2bs4" name="intellectual_property_right_subcategory_id"
                                id="intellectual_property_right_subcategory_id">
                                @foreach ($subcategories as $subCategoryItem => $value)
                                    <option value="{{ $subCategoryItem }}"
                                        {{ twoOptionsIsEqual(old('intellectual_property_right_subcategory_id'), $subCategoryItem) }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- ./Intellectual Property Rights Subcategories  -->
                    </div>
                </div>
                <div class="btn-group">
                    <button class="btn btn-secondary btn-sm">{{ __('buttons.filter') }}</button>
                    <a href="{{ route('admin.intellectual_property_rights.products.create') }}"
                        class="btn btn-danger btn-sm ml-2">{{ __('buttons.register') }}</a>
                </div>
                <hr>
                <h6 class="font-weight-bold">
                    {{ __('pages.admin.intellectual_property_rights.products.filters.total') }}<a
                        class="text-secondary">{{ $total }}</a></h6>
            </form>
        </div>
    </div>
