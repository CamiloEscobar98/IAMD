@extends('admin.layout.app')

@section('title', __('pages.admin.intellectual_property_rights.subcategories.route-titles.show'))

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
                        <li class="breadcrumb-item active">{{ $item->name }}</li>
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
        <p>{!! __('pages.admin.intellectual_property_rights.subcategories.info.show', [
            'subcategory' => $item->name,
            'products_count' => $item->intellectual_property_right_products_count,
        ]) !!}
        </p>

        <div class="pl-3 py-2 bg-gradient-danger rounded">
            <h5 class="font-weight-bold">{{ __('pages.admin.intellectual_property_rights.subcategories.form-titles.show') }}
            </h5>
        </div>

        <!-- Intellectual Property Right Category -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.intellectual_property_rights_category') }}:</label>
            <p>{{ $item->intellectual_property_right_category->name }}</p>
        </div>
        <!-- ./Intellectual Property Right Category -->

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

        <div class="form-group mt-3">
            <a href="{{ route('admin.intellectual_property_rights.subcategories.edit', $item->id) }}"
                class="btn btn-danger btn-sm">{{ __('buttons.update_to') }}</a>
        </div>
    </div>
@endsection



@section('custom_js')
    @include('messages.delete_item', ['title' => __('pages.admin.localizations.states.messages.confirm')])
@endsection
