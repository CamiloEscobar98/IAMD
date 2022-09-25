@extends('client.layout.app')

@section('title', __('pages.client.strategy_categories.route-titles.create'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.client.strategy_categories.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('pages.home.title') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.strategy_categories.index', $client->name) }}">
                                {{ __('pages.client.strategy_categories.title') }} </a>
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
        <div class="card">
            <div class="card-body">
                <h3 class="font-italic font-weight-bold">
                    <u>{{ __('pages.default.title-information') }}</u>
                </h3>
                <p>{!! __('pages.client.strategy_categories.info.create') !!}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3 class="text-center font-weight-bold">
                    <u>{{ __('pages.client.strategy_categories.form-titles.create') }}</u>
                </h3>
                @include('client.pages.strategy_categories.components.form', [
                    'editMode' => false,
                ])
            </div>
        </div>
    </div>
@endsection
