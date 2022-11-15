@extends('client.layout.app')

@section('title', __('pages.client.administrative_units.route-titles.edit'))

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
                        <li class="breadcrumb-item">
                            <a
                                href="{{ getClientRoute('client.administrative_units.show', [$item->id]) }}">{{ $item->name }}</a>
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
                    <u>{{ __('pages.client.administrative_units.form-titles.edit') }}</u>
                </h3>
                <form action="{{ getClientRoute('client.administrative_units.update', [$item->id]) }}"
                    method="post">
                    @csrf
                    @method('PUT')

                    @include('client.pages.administrative_units.components.form')

                    <div class="form-group mt-3">
                        <button class="btn btn-secondary btn-sm">{{ __('buttons.update') }}</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
