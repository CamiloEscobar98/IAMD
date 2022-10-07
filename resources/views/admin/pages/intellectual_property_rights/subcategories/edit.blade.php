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
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-start">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center font-weight-bold">
                            <u>{{ __('pages.admin.intellectual_property_rights.subcategories.form-titles.update') }}</u>
                        </h3>
                        <form action="{{ route('admin.intellectual_property_rights.subcategories.update', $item->id) }}"
                            method="post">
                            @csrf
                            @method('PUT')

                            @include('admin.pages.intellectual_property_rights.subcategories.components.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
