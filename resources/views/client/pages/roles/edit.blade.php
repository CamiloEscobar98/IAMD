@extends('client.layout.app')

@section('title', __('pages.client.roles.route-titles.edit'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.client.roles.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ getClientRoute('client.home') }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ getClientRoute('client.roles.index') }}">
                                {{ __('pages.client.roles.title') }} </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ getClientRoute('client.roles.show', [$item->id]) }}">{{ $item->name }}</a>
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
        <div class="row justify-content-start">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center font-weight-bold">
                            <u>{{ __('pages.client.roles.form-titles.edit') }}</u>
                        </h3>
                        <form action="{{ getClientRoute('client.roles.update', ['item' => $item->id]) }}" method="post">
                            @csrf
                            @method('PUT')

                            @include('client.pages.roles.components.form')

                            <div class="form-group mt-3">
                                <button class="btn btn-secondary btn-sm">{{ __('buttons.update') }}</button>
                            </div>

                        </form>
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
                            <img src="{{ asset('assets/images/roles.png') }}" class="img-fluid mt-3" width="400em"
                                alt="">
                            <p>{!! __('pages.client.roles.info.create') !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
