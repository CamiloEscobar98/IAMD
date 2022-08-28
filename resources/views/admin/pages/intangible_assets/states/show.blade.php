@extends('admin.layout.app')

@section('title', __('pages.admin.intangible_assets.states.route-titles.show'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.admin.intangible_assets.states.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('pages.admin.home.title') }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ __('pages.admin.intangible_assets.title') }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.intangible_assets.states.index') }}">
                                {{ __('pages.admin.intangible_assets.states.title') }} </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $item->name }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-start">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center font-weight-bold">
                            <u>{{ __('pages.admin.intangible_assets.states.form-titles.show') }}</u>
                        </h3>

                        <img src="{{ asset('assets/images/document_type.png') }}" class="img-fluid" alt="">

                        <!-- Name -->
                        <div class="input-group mt-3">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="{{ __('inputs.name') }}" value="{{ $item->name }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-flag"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Name -->

                        <!-- Description -->
                        <div class="input-group mt-3">
                            <textarea class="form-control" rows="5" disabled>{{ $item->description }}</textarea>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-flag"></span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Description -->

                        <div class="form-group mt-3">
                            <a href="{{ route('admin.intangible_assets.states.edit', $item->id) }}"
                                class="btn btn-warning btn-sm">{{ __('buttons.update_to') }}</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content center">
                            <h3 class="text-center font-italic font-weight-bold">
                                <u>{{ __('pages.default.title-information') }}</u>
                            </h3>
                            <img src="{{ asset('assets/images/countries/country-1.png') }}" class="img-fluid mt-4"
                                width="540em">
                            <div class="mb-0">
                                <p>{!! __('pages.admin.intangible_assets.states.info.show', ['state' => $item->name]) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('custom_js')
    @include('messages.delete_item', ['title' => __('pages.admin.localizations.states.messages.confirm')])
@endsection
