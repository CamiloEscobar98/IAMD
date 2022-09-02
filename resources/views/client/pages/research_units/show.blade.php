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
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.home.title') }}</a>
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
        <div class="row justify-content-start">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">

                        <h3 class="text-center font-weight-bold">
                            <u>{{ __('pages.client.research_units.form-titles.show') }}</u>
                        </h3>

                        <!-- Name -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" placeholder="{{ __('inputs.name') }}"
                                value="{{ $item->name }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-file-alt"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Name -->

                        <!-- Code -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" placeholder="{{ __('inputs.code') }}"
                                value="{{ $item->code }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-barcode"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Code -->

                        <!-- Research Unit Category -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control"
                                placeholder="{{ __('inputs.research_unit_category') }}"
                                value="{{ $item->research_unit_category->name }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-microscope nav-icon"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Research Unit Category -->


                        <!-- Administrative Unit -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control"
                                placeholder="{{ __('inputs.administrative_unit_id') }}"
                                value="{{ $item->administrative_unit->name }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-university nav-icon"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Administrative Unit -->

                        <!-- Directror -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" placeholder="{{ __('inputs.director_id') }}"
                                value="{{ $item->director->name }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user-tie nav-icon"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Directror -->

                        <!-- Inventory Manager -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" placeholder="{{ __('inputs.inventory_manager_id') }}"
                                value="{{ $item->inventory_manager->name }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user nav-icon"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Inventory Manager -->

                        <!-- Info -->
                        <div class="input-group mt-3">
                            <textarea class="form-control" cols="30" rows="10" disabled>{{ $item->description }}</textarea>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-sticky-note"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Info -->

                        <!-- Edit Button -->
                        <div class="form-group mt-3">
                            <a href="{{ getClientRoute('client.research_units.edit', [$item->id]) }}"
                                class="btn btn-warning btn-sm">{{ __('buttons.update_to') }}</a>
                        </div>
                        <!-- Edit Button -->


                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h3 class="font-italic font-weight-bold">
                            <u>{{ __('admin_pages.default.title-information') }}</u>
                        </h3>
                        <div class="row justify-content-center">
                            <img src="{{ asset('assets/images/research_units.png') }}" class="img-fluid mt-3"
                                width="400em" alt="">
                            <p>{{ __('pages.client.research_units.info-create') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
