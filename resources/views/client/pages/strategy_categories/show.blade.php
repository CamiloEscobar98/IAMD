@extends('client.layout.app')

@section('title', __('pages.client.strategy_categories.route-titles.show'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.client.strategy_categories.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.strategy_categories.index', $client->name) }}">
                                {{ __('pages.client.strategy_categories.title') }} </a>
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
                <p>{!! __('pages.client.strategy_categories.info.show', ['strategy' => $item->name]) !!}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3 class="font-weight-bold">
                    <u>{{ __('pages.client.strategy_categories.form-titles.show') }}</u>
                </h3>
                <!-- Name -->
                <div class="form-group mt-3">
                    <label>{{ __('inputs.name') }}</label>
                    <p>{{ $item->name }}</p>
                </div>
                <!-- ./Name -->

                <!-- Info -->
                <div class="form-group mt-3">
                    <label>{{ __('inputs.info') }}</label>
                    <p>{{ $item->description }}</p>
                </div>
                <!-- ./Info -->

                <!-- Edit Button -->
                <div class="form-group mt-3">
                    <a href="{{ getClientRoute('client.strategy_categories.edit', [$item->id]) }}"
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
