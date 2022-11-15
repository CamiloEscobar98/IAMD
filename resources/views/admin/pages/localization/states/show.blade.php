@extends('admin.layout.app')

@section('title', __('pages.admin.localizations.states.route-titles.show'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.admin.localizations.states.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ __('pages.admin.localizations.title') }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.localizations.states.index') }}">
                                {{ __('pages.admin.localizations.states.title') }} </a>
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

        <h3 class="font-weight-bold">
            <u>{!! __('pages.default.title-information') !!}</u>
        </h3>
        <p>{!! __('pages.admin.localizations.states.info.show', [
            'state' => $item->name,
            'cities_count' => $item->cities_count,
        ]) !!}
        </p>

        <div class="px-4 py-2 bg-gradient-danger">
            <h4 class="font-weight-bold">{{ __('pages.admin.localizations.states.form-titles.show') }}</h4>
        </div>

        <!-- Country -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.country_id') }}:</label>
            <p>{{ $item->country->name }}</p>
        </div>
        <!-- ./Country -->

        <!-- Name -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.name') }}:</label>
            <p>{{ $item->name }}</p>
        </div>
        <!-- ./Name -->

        <div class="form-group mt-3">
            <a href="{{ route('admin.localizations.states.edit', $item->id) }}"
                class="btn btn-danger btn-sm">{{ __('buttons.update_to') }}</a>
        </div>

        <div class="row mt-2 mb-4 mx-2">
            <h4 class="mb-4">{{ __('pages.admin.localizations.states.cities.title') }}</h4>
            @include('admin.pages.localization.states.components.table_cities')
        </div>
        {!! $links !!}
    </div>
@endsection



@section('custom_js')
    @include('messages.delete_item', ['title' => __('pages.admin.localizations.cities.messages.confirm')])
@endsection
