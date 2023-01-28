@extends('client.layout.app')

@section('title', __('pages.client.intangible_assets.route-titles.show'))

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
                    <h1>{{ __('pages.client.intangible_assets.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.intangible_assets.index', $client->name) }}">
                                {{ __('pages.client.intangible_assets.title') }} </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $item->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="container-fluid">

        <h3 class="font-italic font-weight-bold">
            <u>{{ __('pages.default.title-information') }}</u>
        </h3>
        <p>{!! __('pages.client.intangible_assets.info.show', ['intangible_asset' => $item->name]) !!}</p>

        @can('intangible_assets.generate_report')
            <a href="{{ route('client.intangible_assets.reports.default', [$client->name, $item->id]) }}"
                class="btn btn-sm btn-danger">Descargar Reporte</a>
        @endcan

        @can('intangible_assets.generate_code')
            @if ($item->hasAllPhasesCompleted())
                <a href="{{ getClientRoute('client.intangible_assets.generate_code', [$item->id]) }}"
                    class="btn btn-sm btn-outline-danger">Generar Codificación</a>
            @endif
        @endcan

        @can('intangible_assets.strategies.index')
            @if ($item->hasStrategies())
                <a href="{{ route('client.intangible_assets.strategies.index', [$client->name, $item->id]) }}"
                    class="btn btn-sm btn-danger">{{ __('pages.client.intangible_assets.strategies.button') }}</a>
            @endif
        @endcan

        <div class="card mt-4">
            <div class="card-header bg-danger">
                <h5 class="font-weight-bold">{{ __('pages.client.intangible_assets.form-titles.show') }}</h5>
            </div>
            <div class="card-body">
                @if ($item->hasCode())
                    <div class="form-group">
                        <label>{{ __('inputs.intangible_asset_code') }}</label>
                        <p><i>{{ $item->code }}</i></p>
                    </div>
                @endif

                <!-- Name -->
                <div class="form-group mt-3">
                    <label>{{ __('inputs.name') }}:</label>
                    <p>{{ $item->name }}</p>
                </div>
                <!-- ./Name -->

                <!-- Project -->
                <div class="form-group mt-3">
                    <label>{{ __('inputs.project_id') }}:</label>
                    <p> <a href="{{ getClientRoute('client.projects.show', [$item->project->id]) }}"
                            class="btn btn-sm btn-outline-secondary">{{ $item->project->name }}</a></p>
                </div>
                <!-- ./Project -->

                <!-- Research Units -->
                <div class="form-group mt-3">
                    <label>Unidades Investigantivas:</label>
                    <p>
                        @foreach ($item->research_units as $researchUnit)
                            <a href="{{ getClientRoute('client.projects.show', [$researchUnit->id]) }}"
                                class="btn btn-sm btn-outline-secondary">{{ $researchUnit->name }}</a>
                        @endforeach
                    </p>
                </div>
                <!-- ./Research Units -->

                <!-- Contract Date -->
                <div class="form-group mt-3">
                    <label>{{ __('inputs.intangible_asset_date') }}</label>
                    <p>{{ transformDatetoString($item->date) }}</p>
                </div>
                <!-- ./Contract Date -->

                <hr>

                <!-- Localization -->
                <div class="form-group mt-3">
                    <label>{{ __('inputs.intangible_asset_localization') }}:</label>
                    <p>{{ getParamObject($item->intangible_asset_localization, 'localization') }}</p>
                </div>
                <!-- ./Localization -->

                <!-- Localization Code -->
                <div class="form-group mt-3">
                    <label>{{ __('inputs.intangible_asset_code_localization') }}:</label>
                    <p>{{ getParamObject($item->intangible_asset_localization, 'code', true) }}</p>
                </div>
                <!-- ./Localization Code -->

                <hr>

                <!-- Created At -->
                <div class="form-group mt-3">
                    <label>{{ __('inputs.created_at') }}:</label>
                    <p>{{ transformTimestampToString($item->created_at) }}</p>
                </div>
                <!-- ./Created At -->

                <!-- Updated At -->
                <div class="form-group mt-3">
                    <label>{{ __('inputs.updated_at') }}:</label>
                    <p>{{ transformTimestampToString($item->updated_at) }}</p>
                </div>
                <!-- ./Updated At -->

                @can('intangible_assets.update')
                    <!-- Edit Button -->
                    <div class="form-group mt-4">
                        <a href="{{ getClientRoute('client.intangible_assets.edit', [$item->id]) }}"
                            class="btn btn-danger btn-sm">{{ __('buttons.update_to') }}</a>
                    </div>
                    <!-- Edit Button -->
                @endcan
            </div>
        </div>

        <hr>

        @can('intangible_assets.phases.update')
            <!-- Intangible Asset Process -->
            <div class="card">
                <div class="card-header {{ phaseIsCompletedColor($item->hasStrategies(), true) }}">
                    <h5 class="font-weight-bold">{{ __('pages.client.intangible_assets.strategies.title') }}</h5>
                </div>
                <div class="card-body">

                    <form action="{{ route('client.intangible_assets.has_estrategies', [$client->name, $item->id]) }}"
                        method="post">

                        @csrf

                        @method('PATCH')

                        <div class="form-group">
                            <label>{{ __('pages.client.intangible_assets.strategies.form.has_strategies') }}</label>
                            <select name="has_strategies" class="form-control form-control-sm">
                                <option value="1" {{ intangibleAssetHasStrategies($item) }}>
                                    {{ __('inputs.yes') }}</option>
                                <option value="-1" {{ intangibleAssetHasStrategies($item, true) }}>
                                    {{ __('inputs.no') }}</option>
                            </select>
                        </div>

                        <!-- Button Save -->
                        <div class="form-group">
                            <button
                                class="btn {{ phaseIsCompletedButton($item->hasStrategies()) }} btn-sm">{{ __('buttons.save') }}</button>
                        </div>
                        <!-- ./Button Save -->

                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-danger">
                    <h5 class="font-weight-bold">{{ __('pages.client.intangible_assets.phases.title') }}</h5>
                </div>
                <div class="card-body">
                    <div class="progress mb-4">
                        <div class="progress-bar {{ getStatusBarColor($item->progressPhases()) }}" role="progressbar"
                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                            style="width: {{ $item->progressPhases() }}%">
                            <span class="">{{ round($item->progressPhases()) }}%</span>
                        </div>
                    </div>
                    @include('client.pages.intangible_assets.components.phases', ['item' => $item])
                </div>
            </div>
            <!-- ./Intangible Asset Process -->
        @endcan


    </div>
@endsection

@section('js')
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection


@section('custom_js')
    <script src="{{ asset('adminlte/dist/js/iamd/intangible_asset_levels.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/iamd/intangible_asset_phases.js') }}"></script>

    <script>
        $(document).ready(function() {
            changeIsPublished();
            changeHasConfidencialityContract();
            changeHasSessionRightContract();
            changeHasContability();
            changeHasDeposite();
            changeHasSecretProtection();
            changeHasPriorityTools();
            changeIsCommercial();
        });



        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection
