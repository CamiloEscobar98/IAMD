@extends('client.layout.app')

@section('title', __('pages.client.creators.internal.route-titles.edit'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.client.creators.internal.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.home.title') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.creators.internal.index', $client->name) }}">
                                {{ __('pages.client.creators.internal.title') }} </a>
                        </li>
                        <li class="breadcrumb-item">{{ $item->name }}</li>
                        <li class="breadcrumb-item">{{ __('pages.default.edit') }}</li>
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
                <p>{!! __('pages.client.creators.internal.info.create') !!}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3 class="text-center font-weight-bold">
                    <u>{{ __('pages.client.creators.internal.form-titles.edit') }}</u>
                </h3>
                @include('client.pages.creators.internal.components.form', [
                    'editMode' => true,
                ])
            </div>
        </div>
    </div>
@endsection
