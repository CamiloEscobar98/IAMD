@extends('admin.layout.app')

@section('title', __('admin_pages.intangible_assets.states.titles.edit'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('admin_pages.intangible_assets.states.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('admin.home') }}">{{ __('admin_pages.home.title') }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ __('admin_pages.intangible_assets.title') }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.intangible_assets.states.index') }}">
                                {{ __('admin_pages.intangible_assets.states.title') }} </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.intangible_assets.states.show', $item->id) }}">
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
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center font-weight-bold">
                            <u>{{ __('admin_pages.intangible_assets.states.title-update') }}</u>
                        </h3>
                        @include('admin.pages.intangible_assets.states.components.form', [
                            'editMode' => true,
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
