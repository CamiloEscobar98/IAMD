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
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="font-italic font-weight-bold">
                            <u>{{ __('pages.default.title-information') }}</u>
                        </h3>
                        <p>{!! __('pages.client.intangible_assets.info.show', ['intangible_asset' => $item->name]) !!}</p>
                        <div class="float-left">
                            <a href="{{ route('client.intangible_assets.reports.default', [$client->name, $item->id]) }}"
                                class="btn btn-sm btn-danger">Descargar Reporte</a>
                        </div>
                        @if ($item->hasStrategies())
                            <div class="float-right">
                                <a href="{{ route('client.intangible_assets.strategies.index', [$client->name, $item->id]) }}"
                                    class="btn btn-sm btn-danger">{{ __('pages.client.intangible_assets.strategies.button') }}</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center font-weight-bold">
                            <u>{{ __('pages.client.intangible_assets.form-titles.show') }}</u>
                        </h3>

                        <!-- Name -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" placeholder="{{ __('inputs.name') }}"
                                value="{{ $item->name }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-file-alt"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Name -->

                        <!-- Project -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" placeholder="{{ __('inputs.project') }}"
                                value="{{ $item->project->name }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-microscope nav-icon"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Project -->

                        <br>

                        <!-- Edit Button -->
                        <div class="form-group mt-3">
                            <a href="{{ getClientRoute('client.intangible_assets.edit', [$item->id]) }}"
                                class="btn btn-warning btn-sm">{{ __('buttons.update_to') }}</a>
                        </div>
                        <!-- Edit Button -->
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-header {{ phaseIsCompletedColor($item->hasStrategies(), true) }}">
                <h2 class="float-right">{{ __('pages.client.intangible_assets.strategies.title') }}</h2>
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

        <!-- Intangible Asset Process -->
        <div class="card">
            <div class="card-header bg-gradient-secondary">
                <h2>{{ __('pages.client.intangible_assets.phases.title') }}</h2>
            </div>
            <div class="card-body">
                @include('client.pages.intangible_assets.components.phases', ['item' => $item])
            </div>
        </div>
        <!-- ./Intangible Asset Process -->
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
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection
