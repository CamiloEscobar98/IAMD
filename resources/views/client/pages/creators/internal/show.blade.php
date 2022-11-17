@extends('client.layout.app')

@section('title', __('pages.client.creators.internal.route-titles.show'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.client.creators.internal.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.creators.internal.index', $client->name) }}">
                                {{ __('pages.client.creators.internal.title') }} </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $item->creator->name }}</li>
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
        <p>{!! __('pages.client.creators.internal.info.create') !!}</p>

        <div class="pl-3 py-2 bg-danger text-white">
            <h5 class="font-weight-bold">{{ __('pages.client.creators.internal.form-titles.show') }}</h5>
        </div>
        
        <div class="row mt-2">
            <div class="col-lg-6">
                <!-- Name -->
                <div class="form-group">
                    <label>{{ __('inputs.name') }}</label>
                    <p>{{ $item->creator->name }}</p>
                </div>
                <!-- ./Name -->

                <!-- Email -->
                <div class="form-group">
                    <label>{{ __('inputs.email') }}</label>
                    <p>{{ $item->creator->email }}</p>
                </div>
                <!-- ./Email -->

                <!-- Phone -->
                <div class="form-group">
                    <label>{{ __('inputs.phone') }}</label>
                    <p>{{ $item->creator->phone }}</p>
                </div>
                <!-- ./Phone -->

                <!-- Document Type -->
                <div class="form-group">
                    <label>{{ __('inputs.document_type_id') }}</label>
                    <p>{{ $item->creator->document->document_type->name }}</p>
                </div>
                <!-- ./Document Type -->

                <!-- Document -->
                <div class="form-group">
                    <label>{{ __('inputs.document') }}</label>
                    <p>{{ $item->creator->document->document }}</p>
                </div>
                <!-- ./Document -->
            </div>
            <div class="col-lg-6">

                <!-- Expedition Place -->
                <div class="form-group">
                    <label>{{ __('inputs.country_id') }}:</label>
                    <p>{{ $item->creator->document->expedition_place->state->country->name }}</p>
                </div>

                <div class="form-group">
                    <label>{{ __('inputs.state_id') }}:</label>
                    <p>{{ $item->creator->document->expedition_place->state->name }}</p>
                </div>

                <div class="form-group">
                    <label>{{ __('inputs.city_id') }}:</label>
                    <p>{{ $item->creator->document->expedition_place->name }}</p>
                </div>
                <!-- ./Expedition Place -->

                <!-- Linkage Type -->
                <div class="form-group">
                    <label>{{ __('inputs.linkage_type_id') }}:</label>
                    <p>{{ $item->linkage_type->name }}</p>
                </div>
                <!-- ./Linkage Type -->

                <!-- Assignment Contract -->
                <div class="form-group">
                    <label>{{ __('inputs.assignment_contract_id') }}:</label>
                    <p>{{ $item->assignment_contract->name }}</p>
                </div>
                <!-- ./Assignment Contract -->
            </div>
        </div>

        <!-- Edit Button -->
        <div class="form-group">
            <a href="{{ getClientRoute('client.creators.internal.edit', [$item->creator_id]) }}"
                class="btn btn-danger btn-sm">{{ __('buttons.update_to') }}</a>
        </div>
        <!-- Edit Button -->
    </div>
@endsection
