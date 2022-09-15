@extends('admin.layout.app')

@section('title', __('pages.admin.localizations.countries.route-titles.show'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.admin.localizations.countries.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('pages.admin.home.title') }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ __('pages.admin.localizations.title') }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.localizations.countries.index') }}">
                                {{ __('pages.admin.localizations.countries.title') }} </a>
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
                            <u>{{ __('pages.admin.localizations.countries.form-titles.show') }}</u>
                        </h3>

                        <img src="{{ asset('assets/images/countries/country_flags.png') }}" class="img-fluid"
                            alt="">

                        <!-- Name -->
                        <div class="input-group mt-3">
                            <input type="text" name="name" class="form-control {{ isInvalidByError($errors, 'name') }}"
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
                            <a href="{{ route('admin.localizations.countries.edit', $item->id) }}"
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
                                <u>{{ __('pages.default.title-information') }}</u>
                            </h3>
                            <img src="{{ asset('assets/images/countries/country-1.png') }}" class="img-fluid mt-4"
                                width="540em">
                            <div class="mb-0">
                                <p>{!! __('pages.admin.localizations.countries.info.show', [
                                    'country' => $item->name,
                                    'states_count' => $item->states_count,
                                    'cities_count' => $item->cities_count,
                                ]) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2 mb-4 mx-2">
            <h4 class="mb-4">{{ __('pages.admin.localizations.countries.states.title') }}</h4>
            @include('admin.pages.localization.countries.components.table_states')
        </div>
        {!! $links !!}
    </div>
@endsection



@section('custom_js')
    @include('messages.delete_item', ['title' => __('pages.admin.localizations.states.messages.confirm')])
@endsection
