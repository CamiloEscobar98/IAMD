@extends('client.layout.app')

@section('title', __('pages.client.creators.internal.route-titles.create'))

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
                    <h1>{{ __('pages.client.creators.internal.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('pages.home.title') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.creators.internal.index', $client->name) }}">
                                {{ __('pages.client.creators.internal.title') }} </a>
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
        <div class="row justify-content-start">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center font-weight-bold">
                            <u>{{ __('pages.client.creators.internal.form-titles.create') }}</u>
                        </h3>
                        @include('client.pages.creators.internal.components.form', [
                            'editMode' => false,
                        ])
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h3 class="font-italic font-weight-bold">
                            <u>{{ __('pages.default.title-information') }}</u>
                        </h3>
                        <div class="row justify-content-center">
                            <img src="{{ asset('assets/images/projects.png') }}" class="img-fluid mt-3" width="400em"
                                alt="">
                            <p>{!! __('pages.client.creators.internal.info.create') !!}</p>
                        </div>
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
    @include('messages.delete_item', ['title' => __('pages.client.creators.internal.messages.confirm')])

    <script>
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection
