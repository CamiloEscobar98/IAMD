@extends('client.layout.app')

@section('title', __('pages.client.financing_types.route-titles.edit'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.client.financing_types.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.financing_types.index', $client->name) }}">
                                {{ __('pages.client.financing_types.title') }} </a>
                        </li>
                        <li class="breadcrumb-item">{{ $item->name }}</li>
                        <li class="breadcrumb-item active">{{ __('pages.default.edit') }}</li>
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
                <p>{!! __('pages.client.financing_types.info.edit', ['financing_type' => $item->name]) !!}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3 class="font-weight-bold">
                    <u>{{ __('pages.client.financing_types.form-titles.edit') }}</u>
                </h3>

                <form action="{{ getClientRoute('client.financing_types.update', [$item->id]) }}" method="post">
                    @csrf
                    @method('PUT')

                    @include('client.pages.financing_types.components.form')

                    <div class="form-group mt-3">
                        <button class="btn btn-secondary btn-sm">{{ __('buttons.update') }}</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
