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
                        <p>{!! __('pages.client.intangible_assets.info.create') !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center font-weight-bold">
                            <u>{{ __('pages.client.intangible_assets.form-titles.create') }}</u>
                        </h3>

                        <form action="{{ route('client.intangible_assets.store', $client->name) }}" method="post"
                            data-client="{{ $client->name }}" id="form">
                            @csrf

                            @include('client.pages.intangible_assets.components.form')

                            <!-- Button Save -->
                            <div class="form-group mt-3">
                                <button class="btn btn-secondary btn-sm">{{ __('buttons.save') }}</button>
                            </div>
                            <!-- ./Button Save -->

                        </form>
                    </div>
                </div>
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
    </script>
@endsection
