@extends('admin.layout.app')

@section('title', __('pages.admin.localizations.cities.titles.show'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.admin.localizations.cities.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ __('pages.admin.localizations.title') }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.localizations.cities.index') }}">
                                {{ __('pages.admin.localizations.cities.title') }} </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $item->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="container-fluid">

        <h4 class="font-weight-bold">
            <u>{{ __('pages.default.title-information') }}</u>
        </h4>

        <p>{!! __('pages.admin.localizations.cities.info.show', ['city' => $item->name]) !!}</p>

        <div class="bg-danger text-white pl-3 py-2">
            <h4 class="font-weight-bold">{{ __('pages.admin.localizations.cities.form-titles.show') }}</h4>
        </div>

        <!-- Country -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.country_id') }}:</label>
            <p>{{ $item->country->name }}</p>
        </div>
        <!-- ./Country -->

        <!-- State -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.state_id') }}:</label>
            <p>{{ $item->state->name }}</p>
        </div>
        <!-- ./State -->

        <!-- Name -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.name') }}:</label>
            <p>{{ $item->name }}</p>
        </div>
        <!-- ./Name -->

        <hr>

        <!-- Created At -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.created_at') }}:</label>
            <p>{{ transformTimestampToString($item->created_at) }}</p>
        </div>
        <!-- ./Created At -->

        <!-- Updated At -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.updated_at') }}:</label>
            <p>{{ transformTimestampToString($item->updated_at) }}</p>
        </div>
        <!-- ./Updated At -->

        <!-- Button -->
        <div class="form-group mt-3">
            <a href="{{ route('admin.localizations.cities.edit', $item->id) }}"
                class="btn btn-danger btn-sm">{{ __('buttons.update_to') }}</a>
        </div>
        <!-- ./Button -->
    </div>
@endsection



@section('custom_js')
    @include('messages.delete_item', ['title' => __('pages.admin.localizations.cities.messages.confirm')])
@endsection
