@extends('client.layout.app')

@section('title', __('pages.client.creators.external.route-titles.show'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.client.creators.external.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.home.title') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.creators.external.index', $client->name) }}">
                                {{ __('pages.client.creators.external.title') }} </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $item->creator->name }}</li>
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
                            <u>{{ __('pages.client.creators.external.form-titles.show') }}</u>
                        </h3>

                        <!-- Name -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" placeholder="{{ __('inputs.name') }}"
                                value="{{ $item->creator->name }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Name -->

                        <!-- Phone -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" placeholder="{{ __('inputs.phone') }}"
                                value="{{ $item->creator->phone }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Phone -->

                        <!-- Document -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" placeholder="{{ __('inputs.document') }}"
                                value="{{ $item->creator->document->document }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-id-card"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Document -->

                        <!-- Document Type -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" placeholder="{{ __('inputs.document_type') }}"
                                value="{{ $item->creator->document->document_type->name }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-address-card"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Document Type -->

                        <!-- Expedition Place -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" placeholder="{{ __('inputs.expedition_place') }}"
                                value="{{ $item->creator->document->expedition_place->name }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-flag"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Expedition Place -->

                        <!-- Email -->
                        <div class="input-group mt-3">
                            <input type="email" class="form-control" placeholder="{{ __('inputs.email') }}"
                                value="{{ $item->creator->email }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Email -->

                        <!-- External Organization -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" placeholder="{{ __('inputs.external_organization_id') }}"
                                value="{{ $item->external_organization->name }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-industry"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./External Organization -->

                        <!-- Assignment Contract -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" placeholder="{{ __('inputs.assignment_contract') }}"
                                value="{{ $item->assignment_contract->name }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user-tie"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Assignment Contract -->

                        <!-- Edit Button -->
                        <div class="form-group mt-3">
                            <a href="{{ getClientRoute('client.creators.external.edit', [$item->creator_id]) }}"
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
                            <u>{{ __('pages.default.title-information') }}</u>
                        </h3>
                        <div class="row justify-content-center">
                            <img src="{{ asset('assets/images/administrative_units.png') }}" class="img-fluid mt-3"
                                width="400em" alt="">
                            <p>{!! __('pages.client.creators.external.info.create') !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
