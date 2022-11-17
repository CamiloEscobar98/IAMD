@extends('client.layout.app')

@section('title', __('pages.client.project_contract_types.route-titles.create'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.client.project_contract_types.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.project_contract_types.index', $client->name) }}">
                                {{ __('pages.client.project_contract_types.title') }} </a>
                        </li>
                        <li class="breadcrumb-item">{{ __('pages.default.create') }}</li>
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
        <p>{!! __('pages.client.project_contract_types.info.create') !!}</p>
        <div class="card">
            <div class="card-header bg-danger">
                <h5 class="font-weight-bold">{{ __('pages.client.project_contract_types.form-titles.create') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('client.project_contract_types.store', $client->name) }}" method="post">
                    @csrf

                    @include('client.pages.project_contract_types.components.form')

                    <div class="form-group mt-3">
                        <button class="btn btn-danger btn-sm">{{ __('buttons.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
