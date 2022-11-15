@extends('client.layout.app')

@section('title', __('pages.client.research_units.route-titles.show'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.client.research_units.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.research_units.index', $client->name) }}">
                                {{ __('pages.client.research_units.title') }} </a>
                        </li>
                        <li class="breadcrumb-item">{{ $item->name }}</li>
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
                <p>{!! __('pages.client.research_units.info.show', ['research_unit' => $item->name]) !!}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">

                <h3 class="font-weight-bold">
                    <u>{{ __('pages.client.research_units.form-titles.show') }}</u>
                </h3>

                <!-- Name -->
                <div class="form-group mt-3">
                    <label>{{ __('inputs.name') }}:</label>
                    <p>{{ $item->name }}</p>
                </div>
                <!-- ./Name -->

                <!-- Code -->
                <div class="form-group mt-3">
                    <label>{{ __('inputs.code') }}:</label>
                    <p>{{ $item->code }}</p>
                </div>
                <!-- ./Code -->

                <!-- Administrative Unit -->
                <div class="form-group mt-3">
                    <label>{{ __('inputs.administrative_unit_id') }}:</label>

                    <p>
                        <a href="{{ getClientRoute('client.administrative_units.show', [$item->administrative_unit->id]) }}"
                            class="btn btn-sm btn-outline-secondary">{{ getParamObject($item->administrative_unit, 'name') }}</a>
                    </p>
                </div>
                <!-- ./Administrative Unit -->

                <!-- Research Unit Category -->
                <div class="form-group mt-3">
                    <label>{{ __('inputs.research_unit_category_id') }}:</label>
                    <p>{{ getParamObject($item->research_unit_category, 'name') }}</p>
                </div>
                <!-- ./Research Unit Category -->

                <!-- Directror -->
                <div class="form-group mt-3">
                    <label>{{ __('inputs.director_id') }}:</label>
                    <p>
                        <a href="{{ getClientRoute('client.' . $item->director->creator_type_route . '.show', [$item->director->id]) }}"
                            class="btn btn-sm btn-outline-secondary">{{ getParamObject($item->director, 'name') }}</a>
                    </p>
                </div>
                <!-- ./Directror -->

                <!-- Inventory Manager -->
                <div class="form-group mt-3">
                    <label>{{ __('inputs.inventory_manager_id') }}:</label>
                    <p>
                        <a href="{{ getClientRoute('client.' . $item->inventory_manager->creator_type_route . '.show', [$item->inventory_manager->id]) }}"
                            class="btn btn-sm btn-outline-secondary">{{ getParamObject($item->inventory_manager, 'name') }}</a>
                    </p>
                </div>
                <!-- ./Inventory Manager -->

                <!-- Description -->
                <div class="form-group mt-3">
                    <label>{{ __('inputs.description') }}:</label>
                    <p>{{ $item->description }}</p>
                </div>
                <!-- ./Description -->

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

                <!-- Edit Button -->
                <div class="form-group mt-4">
                    <a href="{{ getClientRoute('client.research_units.edit', [$item->id]) }}"
                        class="btn btn-warning btn-sm">{{ __('buttons.update_to') }}</a>
                </div>
                <!-- Edit Button -->
            </div>
        </div>
    </div>
@endsection
