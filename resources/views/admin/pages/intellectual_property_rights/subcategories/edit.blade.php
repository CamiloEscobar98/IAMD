@extends('admin.layout.app')

@section('title', __('pages.admin.intellectual_property_rights.subcategories.route-titles.edit'))

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
                        <li class="breadcrumb-item">{{ __('pages.admin.localizations.title') }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.intellectual_property_rights.subcategories.index') }}">
                                {{ __('pages.admin.intellectual_property_rights.subcategories.title') }} </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.intellectual_property_rights.subcategories.show', $item->id) }}">
                                {{ $item->name }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Editar</li>
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
        <p>{!! __('pages.admin.intellectual_property_rights.subcategories.info.edit', ['subcategory' => $item->name]) !!}</p>

        <div class="card">
            <div class="card-header bg-danger">
                <h5 class="font-weight-bold">
                    {{ __('pages.admin.intellectual_property_rights.subcategories.form-titles.update') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.intellectual_property_rights.subcategories.update', $item->id) }}"
                    method="post">
                    @csrf
                    @method('PUT')

                    @include('admin.pages.intellectual_property_rights.subcategories.components.form')

                    <div class="form-group mt-3">
                        <button class="btn btn-danger btn-sm">{{ __('buttons.update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
