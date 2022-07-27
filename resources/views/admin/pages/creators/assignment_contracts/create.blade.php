@extends('admin.layout.app')

@section('title', __('admin_pages.creators.assignment_contracts.titles.create'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('admin_pages.creators.assignment_contracts.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('pages.home.title') }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ __('admin_pages.creators.title') }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.creators.assignment_contracts.index') }}">
                                {{ __('admin_pages.creators.assignment_contracts.title') }} </a>
                        </li>
                        <li class="breadcrumb-item">{{ __('admin_pages.default.create') }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-start">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center font-weight-bold">
                            <u>{{ __('admin_pages.creators.assignment_contracts.title-form') }}</u>
                        </h3>
                        {!! $form !!}
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content center">
                            <h3 class="text-center font-italic font-weight-bold">
                                <u>{{ __('admin_pages.default.title-information') }}</u>
                            </h3>
                            <img src="{{ asset('assets/images/countries/country-1.png') }}" class="img-fluid mt-3"
                                alt="">
                            <p>{{ __('admin_pages.creators.assignment_contracts.info-create') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
