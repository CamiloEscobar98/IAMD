@extends('client.layout.app')

@section('title', __('pages.client.administrative_units.route-titles.show'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.client.administrative_units.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ getClientRoute('client.home') }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ getClientRoute('client.administrative_units.index') }}">
                                {{ __('pages.client.administrative_units.title') }} </a>
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
        <div class="row justify-content-start">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center font-weight-bold">
                            <u>{{ __('pages.client.administrative_units.form-titles.show') }}</u>
                        </h3>
                        <!-- Name -->
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" placeholder="{{ __('inputs.name') }}"
                                value="{{ $item->name }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-university"> [Nombre]</span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Name -->

                        <!-- Info -->
                        <div class="input-group mt-3">
                            <textarea class="form-control" cols="30" rows="10" disabled>{{ $item->info }}</textarea>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-info"> [Descripción]</span>
                                </div>
                            </div>
                        </div>
                        <!-- ./Info -->

                        <!-- Edit Button -->
                        <div class="form-group mt-3">
                            <a href="{{ getClientRoute('client.administrative_units.edit', [$item->id]) }}"
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
                            <p>{!! __('pages.client.administrative_units.info.show', ['administrative_unit' => $item->name]) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
