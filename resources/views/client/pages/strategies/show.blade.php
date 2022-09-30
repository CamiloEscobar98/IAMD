@extends('client.layout.app')

@section('title', __('pages.client.strategies.route-titles.show'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.client.strategies.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.strategies.index', $client->name) }}">
                                {{ __('pages.client.strategies.title') }} </a>
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
        <div class="card">
            <div class="card-body">
                <h3 class="font-italic font-weight-bold">
                    <u>{{ __('pages.default.title-information') }}</u>
                </h3>
                <p>{!! __('pages.client.strategies.info.show', ['strategy' => $item->name]) !!}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3 class="text-center font-weight-bold">
                    <u>{{ __('pages.client.strategies.form-titles.show') }}</u>
                </h3>
                <!-- Name -->
                <div class="input-group mt-3">
                    <input type="text" class="form-control" placeholder="{{ __('inputs.name') }}"
                        value="{{ $item->name }}" disabled>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-flag"></span>
                        </div>
                    </div>
                </div>
                <!-- ./Name -->

                <!-- Info -->
                <div class="input-group mt-3">
                    <textarea class="form-control" cols="30" rows="10" disabled>{{ $item->info }}</textarea>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-flag"></span>
                        </div>
                    </div>
                </div>
                <!-- ./Info -->

                <!-- Edit Button -->
                <div class="form-group mt-3">
                    <a href="{{ getClientRoute('client.strategies.edit', [$item->id]) }}"
                        class="btn btn-warning btn-sm">{{ __('buttons.update_to') }}</a>
                </div>
                <!-- Edit Button -->


            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-md-7">

            </div>
            <div class="col-md-5">

            </div>
        </div>
    </div>
@endsection
