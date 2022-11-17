@extends('admin.layout.app')

@section('title', __('pages.admin.intangible_assets.states.route-titles.create'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.admin.intangible_assets.states.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ __('pages.admin.intangible_assets.title') }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.intangible_assets.status.index') }}">
                                {{ __('pages.admin.intangible_assets.states.title') }} </a>
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
        <p>{!! __('pages.admin.intangible_assets.states.info.create') !!}</p>

        <div class="row justify-content-start">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-danger">
                        <h5 class="font-weight-bold">{{ __('pages.admin.intangible_assets.states.form-titles.form') }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.intangible_assets.status.store') }}" method="post">
                            @csrf

                            @include('admin.pages.intangible_assets.states.components.form')

                            <div class="form-group mt-3">
                                <button class="btn btn-danger btn-sm">{{ __('buttons.save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
