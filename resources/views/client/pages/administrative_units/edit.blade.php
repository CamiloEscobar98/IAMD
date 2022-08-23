@extends('client.layout.app')

@section('title', __('client_pages.administrative_units.titles.edit'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('client_pages.administrative_units.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.home.title') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.administrative_units.index', $client->name) }}">
                                {{ __('client_pages.administrative_units.title') }} </a>
                        </li>
                        <li class="breadcrumb-item">{{ $item->name }}</li>
                        <li class="breadcrumb-item">{{ __('client_pages.default.edit') }}</li>
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
                            <u>{{ __('client_pages.administrative_units.title-edit') }}</u>
                        </h3>
                        @include('client.pages.administrative_units.components.form', [
                            'editMode' => true,
                        ])
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
                            <img src="{{ asset('assets/images/administrative_units.png') }}" class="img-fluid mt-3"
                                width="400em" alt="">
                            <p>{{ __('client_pages.administrative_units.info-create') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
