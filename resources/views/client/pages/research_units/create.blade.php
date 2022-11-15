@extends('client.layout.app')

@section('title', __('pages.client.research_units.route-titles.create'))

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
                    <h1>{{ __('pages.client.research_units.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.research_units.index', $client->name) }}">
                                {{ __('pages.client.research_units.title') }} </a>
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
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="font-italic font-weight-bold">
                            <u>{{ __('pages.default.title-information') }}</u>
                        </h3>
                        <p>{!! __('pages.client.research_units.info.create') !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="font-weight-bold">
                            <u>{{ __('pages.client.research_units.form-titles.create') }}</u>
                        </h3>
                        <form action="{{ route('client.research_units.store', $client->name) }}" method="post">
                            @csrf

                            @include('client.pages.research_units.components.form')

                            <div class="form-group mt-4">
                                <button class="btn btn-danger btn-sm">{{ __('buttons.save') }}</button>
                            </div>

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
    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection
