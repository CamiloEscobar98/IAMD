@extends('admin.layout.app')

@section('title', __('pages.admin.intellectual_property_rights.subcategories.route-titles.create'))

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
                    <h1>{{ __('pages.admin.intellectual_property_rights.subcategories.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ __('pages.admin.intellectual_property_rights.title') }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.intellectual_property_rights.subcategories.index') }}">
                                {{ __('pages.admin.intellectual_property_rights.subcategories.title') }} </a>
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
        <div class="card">
            <div class="card-body">
                <div class="row justify-content center">
                    <h3 class="text-center font-italic font-weight-bold">
                        <u>{{ __('pages.default.title-information') }}</u>
                    </h3>
                    <p>{!! __('pages.admin.intellectual_property_rights.subcategories.info.create') !!}</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center font-weight-bold">
                            <u>{{ __('pages.admin.intellectual_property_rights.subcategories.form-titles.create') }}</u>
                        </h3>
                        <form action="{{ route('admin.intellectual_property_rights.subcategories.store') }}" method="post">
                            @csrf
                            @include('admin.pages.intellectual_property_rights.subcategories.components.form')
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">

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
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection
