@extends('client.layout.app')

@section('title', __('pages.client.strategies.route-titles.edit'))

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
                        <li class="breadcrumb-item">
                            <a
                                href="{{ route('client.strategies.show', [$client->name, $item->id]) }}">{{ $item->name }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('pages.default.edit') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="container-fluid">
        <h3 class="font-weight-bold">
            <u>{{ __('pages.default.title-information') }}</u>
        </h3>
        <p>{!! __('pages.client.strategies.info.edit', ['strategy' => $item->name]) !!}</p>
        <div class="card">
            <div class="card-header bg-danger">
                <h5 class="font-weight-bold">{{ __('pages.client.strategies.form-titles.edit') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ getClientRoute('client.strategies.update', [$item->id]) }}" method="post">
                    @csrf
                    @method('PUT')

                    @include('client.pages.strategies.components.form')

                    <div class="form-group mt-3">
                        <button class="btn btn-danger btn-sm">{{ __('buttons.update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
