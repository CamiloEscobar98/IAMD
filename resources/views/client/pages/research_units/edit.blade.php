@extends('client.layout.app')

@section('title', __('pages.client.research_units.route-titles.edit'))

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
                        <li class="breadcrumb-item"><a
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.research_units.index', $client->name) }}">
                                {{ __('pages.client.research_units.title') }} </a>
                        </li>
                        <li class="breadcrumb-item">{{ $item->name }}</li>
                        <li class="breadcrumb-item">{{ __('pages.default.edit') }}</li>
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
                        <p>{!! __('pages.client.research_units.info.show', ['research_unit' => $item->name]) !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center font-weight-bold">
                            <u>{{ __('pages.client.research_units.form-titles.edit') }}</u>
                        </h3>
                        <form action="{{ getClientRoute('client.research_units.update', [$item->id]) }}" method="post">
                            @csrf
                            @method('PUT')

                            @include('client.pages.research_units.components.form')

                            <div class="form-group mt-3">
                                <button class="btn btn-secondary btn-sm">{{ __('buttons.update') }}</button>
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
