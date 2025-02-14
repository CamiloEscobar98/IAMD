@extends('client.layout.app')

@section('title', __('pages.client.project_contract_types.route-titles.show'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.client.project_contract_types.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.project_contract_types.index', $client->name) }}">
                                {{ __('pages.client.project_contract_types.title') }} </a>
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
        <p>{!! __('pages.client.project_contract_types.info.show', ['project_contract_type' => $item->name]) !!}</p>

        <div class="pl-3 py-2 bg-danger text-white">
            <h5 class="font-weight-bold">{{ __('pages.client.project_contract_types.form-titles.show') }}</h5>
        </div>

        <!-- Name -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.name') }}:</label>
            <p>{{ $item->name }}</p>
        </div>
        <!-- ./Name -->

        <!-- Code -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.code') }}:</label>
            <p>{{ getParamObject($item, 'code', true) }}</p>
        </div>
        <!-- ./Code -->

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

        @if (role_can_permission('project_contract_types.update'))
            <!-- Edit Button -->
            <div class="form-group mt-3">
                <a href="{{ getClientRoute('client.project_contract_types.edit', [$item->id]) }}"
                    class="btn btn-danger btn-sm">{{ __('buttons.update_to') }}</a>
            </div>
            <!-- Edit Button -->
        @endif
    </div>
@endsection
