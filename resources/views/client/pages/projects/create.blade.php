@extends('client.layout.app')

@section('title', __('pages.client.projects.route-titles.create'))

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
                    <h1>{{ __('pages.client.projects.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.projects.index', $client->name) }}">
                                {{ __('pages.client.projects.title') }} </a>
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
        <p>{!! __('pages.client.projects.info.create') !!}</p>
        <div class="card">
            <div class="card-header bg-danger">
                <h5 class="font-weight-bold">{{ __('pages.client.projects.form-titles.create') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('client.projects.store', $client->name) }}" method="post" id="form"
                    data-client="{{ $client->name }}">
                    @csrf

                    @include('client.pages.projects.components.form')

                    <div class="form-group mt-4">
                        <button class="btn btn-danger btn-sm">{{ __('buttons.save') }}</button>
                    </div>

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
            placeholder: '--Seleccionar las unidades de investigación',
            allowClear: true
        })

        $('#financing_type_id').select2({
            theme: 'bootstrap4',
            placeholder: '--Seleccionar las unidades de investigación',
            allowClear: true
        })
    </script>
@endsection
