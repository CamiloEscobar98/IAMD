@extends('client.layout.app')

@section('title', __('pages.client.reports.custom.title'))

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.client.reports.custom.title') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">{{ __('pages.client.reports.subtitle') }}</li>
                        <li class="breadcrumb-item active">{{ __('pages.client.reports.custom.title') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="container-fluid">


        <form action="{{ getClientRoute('client.intangible_assets.reports.custom') }}" method="get" id="form"
            data-client="{{ $client->name }}">

            @error('empty_graphics')
                <p class="text-danger font-weight-bold">{!! $message !!}</p>
            @enderror

            <!-- Filters -->
            <h5 class="font-weight-bold">{{ __('pages.client.reports.custom.sections.filters.title') }}</h5>

            <!-- Phases Completed -->
            <div class="row justify-content-center">

                <!-- Project -->
                <div class="col-xl-6">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.projects') }}</label>
                        </div>
                        <select name="project_id" id="project_id"
                            class="form-control select2bs4 projects @error('project_id') is-invalid @enderror">
                            @foreach ($projects as $project => $value)
                                <option value="{{ $project }}"
                                    {{ optionIsSelected($params, 'project_id', $project) }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- ./Project -->

                <!-- Intangible Assets Completed Phases -->
                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.phases_completed') }}</label>
                        </div>
                        <select name="phases[]" class="form-control select2bs4 phases" multiple>
                            @foreach ($phases as $phase => $value)
                                <option value="{{ $phase }}" {{ optionInArray($params, 'phases', $phase) }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- ./Intangible Assets Completed Phases -->
            </div>
            <!-- ./Phases Completed -->

            <!-- Orders -->
            <div class="row justify-content-start">
                <div class="col-lg-4">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <label class="input-group-text">{{ __('filters.order_by') }}</label>
                        </div>
                        <select name="order_by" class="form-control select2bs4 order_by">
                            @foreach ($ordersBy as $orderBy => $value)
                                <option value="{{ $orderBy }}" {{ optionInArray($params, 'order_by', $orderBy) }}>
                                    {{ $value }}</option>
                            @endforeach
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
            <!-- ./Orders -->

            <!-- ./Filters -->

            <!-- Graphics -->
            <h5 class="font-weight-bold">{{ __('pages.client.reports.custom.sections.contents.graphics') }} </h5>
            <div class="row mx-2 mt-2">
                @foreach ($graphics as $index => $graphicItem)
                    <div class="col-md-6 mt-3">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="{{ $graphicItem['name'] }}" class="custom-control-input"
                                id="switch-graphic-{{ $index }}">
                            <label class="custom-control-label"
                                for="switch-graphic-{{ $index }}">{{ $graphicItem['value'] }}</label>
                        </div>
                    </div>
                @endforeach

            </div>
            <!-- ./Graphics -->

            <button type="submit" class="mt-4 btn btn-danger btn-sm">{{ __('buttons.report') }}</button>
        </form>
    </div>
@endsection

@section('js')
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection

@section('custom_js')
    <script src="{{ asset('adminlte/dist/js/iamd/projects.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/iamd/intangible_asset_levels.js') }}"></script>

    <script>
        //Initialize Select2 Elements

        $('.intellectual_property_right_categories').select2({
            theme: 'bootstrap4',
        });

        $('.intellectual_property_right_subcategories').select2({
            theme: 'bootstrap4',
        });

        $('.intellectual_property_right_products').select2({
            theme: 'bootstrap4',
        });

        $('.administrative_units').select2({
            theme: 'bootstrap4',
        });

        $('.research_units').select2({
            theme: 'bootstrap4',
        });

        $('.projects').select2({
            theme: 'bootstrap4',
        });

        $('.order_by').select2({
            theme: 'bootstrap4',
        });

        $('.phases').select2({
            theme: 'bootstrap4',
            placeholder: 'Seleccionar las Fases',
            allowClear: true
        });
    </script>
@endsection
