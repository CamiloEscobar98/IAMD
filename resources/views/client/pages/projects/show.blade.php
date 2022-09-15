@extends('client.layout.app')

@section('title', __('pages.client.projects.route-titles.show'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.client.projects.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.home.title') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.projects.index', $client->name) }}">
                                {{ __('pages.client.projects.title') }} </a>
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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">

                        <h3 class="text-center font-weight-bold">
                            <u>{{ __('pages.client.projects.form-titles.show') }}</u>
                        </h3>

                        <!-- Name -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" value="{{ $item->name }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-file-alt"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Name -->

                        <!-- Research Unit -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" value="{{ $item->research_unit->name }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-microscope nav-icon"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Research Unit -->

                        <!-- Directror -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" value="{{ $item->director->name }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user-tie nav-icon"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Directror -->

                        <!-- Description -->
                        <div class="input-group mt-3">
                            <textarea class="form-control" cols="30" rows="5" disabled>{{ $item->description }}</textarea>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-sticky-note"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Description -->

                        <hr>

                        <!-- Financing Types -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control"
                                value="{{ $item->project_financing->financing_type->name }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user-tie nav-icon"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Financing Types -->

                        <!-- Project Contract Types -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control"
                                value="{{ $item->project_financing->project_contract_type->name }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user-tie nav-icon"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Project Contract Types -->

                        <!-- Contract -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" value="{{ $item->project_financing->contract }}"
                                disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user-tie nav-icon"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Contract -->

                        <!-- Date -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" value="{{ $item->project_financing->date }}"
                                disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user-tie nav-icon"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Date -->


                        <!-- Edit Button -->
                        <div class="form-group mt-3">
                            <a href="{{ getClientRoute('client.projects.edit', [$item->id]) }}"
                                class="btn btn-warning btn-sm">{{ __('buttons.update_to') }}</a>
                        </div>
                        <!-- Edit Button -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="font-italic font-weight-bold">
                            <u>{{ __('pages.default.title-information') }}</u>
                        </h3>
                        <div class="row justify-content-center">
                            <img src="{{ asset('assets/images/projects.png') }}" class="img-fluid mt-3" width="400em"
                                alt="">
                            <p>{!! __('pages.client.projects.info.show', ['project' => $item->name]) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('client.pages.intangible_assets.components.table_intangible_assets')
    </div>
@endsection

@section('custom_js')
    @include('messages.delete_item', ['title' => __('pages.client.intangible_assets.messages.confirm')])
@endsection
