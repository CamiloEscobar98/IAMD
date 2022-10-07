@extends('admin.layout.app')

@section('title', __('pages.admin.intellectual_property_rights.categories.route-titles.edit'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.admin.intellectual_property_rights.categories.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ __('pages.admin.intellectual_property_rights.title') }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.intellectual_property_rights.categories.index') }}">
                                {{ __('pages.admin.intellectual_property_rights.categories.title') }} </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.intellectual_property_rights.categories.show', $item->id) }}">
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
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center font-weight-bold">
                            <u>{{ __('pages.admin.intellectual_property_rights.categories.form-titles.update') }}</u>
                        </h3>
                        <form action="{{ route('admin.intellectual_property_rights.categories.update', $item->id) }}"
                            method="post">
                            @csrf
                            @method('PUT')
                            @include('admin.pages.intellectual_property_rights.categories.components.form')

                            <div class="form-group mt-3">
                                <button class="btn btn-secondary btn-sm">{{ __('buttons.update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
