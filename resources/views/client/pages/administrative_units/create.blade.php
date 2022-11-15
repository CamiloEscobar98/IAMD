@extends('client.layout.app')

@section('title', __('pages.client.administrative_units.route-titles.create'))

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
                        <li class="breadcrumb-item">{{ __('pages.default.create') }}</li>
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
                <p>{!! __('pages.client.administrative_units.info.create') !!}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3 class="font-weight-bold">
                    <u>{{ __('pages.client.administrative_units.form-titles.create') }}</u>
                </h3>
                <form action="{{ route('client.administrative_units.store', $client->name) }}" method="post">
                    @csrf

                    @include('client.pages.administrative_units.components.form')

                    <div class="form-group mt-3">
                        <button class="btn btn-secondary btn-sm">{{ __('buttons.save') }}</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
