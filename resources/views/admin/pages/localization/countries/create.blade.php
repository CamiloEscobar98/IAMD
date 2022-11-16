@extends('admin.layout.app')

@section('title', __('pages.admin.localizations.countries.route-titles.create'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.admin.localizations.countries.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ __('pages.admin.localizations.title') }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.localizations.countries.index') }}">
                                {{ __('pages.admin.localizations.countries.title') }} </a>
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
        <h3 class="font-weight-bold">
            <u>{{ __('pages.default.title-information') }}</u>
        </h3>
        <p>{!! __('pages.admin.localizations.countries.info.create') !!}</p>

        <div class="card">
            <div class="card-header bg-gradient-danger">
                <h5 class="font-weight-bold">{{ __('pages.admin.localizations.countries.form-titles.create') }}</h5>
            </div>
            <div class="card-body">
                <h3> </h3>

                <form action="{{ route('admin.localizations.countries.store') }}" method="post">
                    @csrf

                    @include('admin.pages.localization.countries.components.form')

                    <div class="form-group mt-3">
                        <button class="btn btn-danger btn-sm">{{ __('buttons.save') }}</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
