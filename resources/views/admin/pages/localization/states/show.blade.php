@extends('admin.layout.app')

@section('title', __('admin_pages.localizations.states.titles.show'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('admin_pages.localizations.states.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('admin_pages.home.title') }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ __('admin_pages.localizations.title') }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.localizations.states.index') }}">
                                {{ __('admin_pages.localizations.states.title') }} </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $item->name }}</li>
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
                            <u>{{ __('admin_pages.localizations.states.title-show') }}</u>
                        </h3>

                        <img src="{{ asset('assets/images/countries/country_flags.png') }}" class="img-fluid"
                            alt="">

                        <!-- Name -->
                        <div class="input-group mt-3">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="{{ __('inputs.name') }}" value="{{ $item->name }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-flag"></span>
                                </div>
                            </div>
                        </div>

                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <!-- ./Name -->

                        <div class="form-group mt-3">
                            <a href="{{ route('admin.localizations.states.edit', $item->id) }}"
                                class="btn btn-warning btn-sm">{{ __('buttons.update_to') }}</a>
                        </div>

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
                            <img src="{{ asset('assets/images/countries/country-1.png') }}" class="img-fluid mt-4"
                                width="540em">
                            <div class="mb-0">
                                <p>{{ __('admin_pages.localizations.states.info-show', ['state' => $item->name, 'cities_count' => $item->cities_count]) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2 mb-4">
            <h4 class="font-weight-bold mb-4">{{ __('admin_pages.localizations.states.cities.title') }}</h4>
            @include('admin.pages.localization.states.components.table_cities')
        </div>
        {!! $links !!}
    </div>
@endsection



@section('custom_js')
    @include('messages.delete_item', ['title' => __('admin_pages.localizations.cities.messages.confirm')])
@endsection
