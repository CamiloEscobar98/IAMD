@extends('client.layout.app')

@section('title', __('pages.client.intangible_assets.route-titles.create'))

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
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.intangible_assets.index', $client->name) }}">
                                {{ __('pages.client.intangible_assets.title') }} </a>
                        </li>
                        <li class="breadcrumb-item">{{ __('pages.default.create') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="container-fluid">

        <h3 class="font-weight-bold">
            <u>{{ __('pages.default.title-information') }}</u>
        </h3>
        <p>{!! __('pages.client.intangible_assets.info.create') !!}</p>

        <div class="card">
            <div class="card-header bg-danger">
                <h5 class="font-weight-bold">{{ __('pages.client.intangible_assets.form-titles.create') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('client.intangible_assets.store', $client->name) }}" method="post"
                    data-client="{{ $client->name }}" id="form">
                    @csrf

                    @include('client.pages.intangible_assets.components.form')

                    <!-- Button Save -->
                    <div class="form-group mt-3">
                        <button class="btn btn-danger btn-sm">{{ __('buttons.save') }}</button>
                    </div>
                    <!-- ./Button Save -->

                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection

@section('custom_js')
    <script src="{{ asset('adminlte/dist/js/iamd/projects.js') }}"></script>

    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('#research_unit_id').select2({
            theme: 'bootstrap4',
            placeholder: '---Seleccionar Unidades Investigativas'
        })
    </script>
@endsection
