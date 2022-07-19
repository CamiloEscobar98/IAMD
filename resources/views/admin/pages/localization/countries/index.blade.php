@extends('admin.layout.app')

@section('title', __('pages.localizations.countries.title'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.localizations.countries.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('pages.home.title') }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ __('pages.localizations.title') }}</li>
                        <li class="breadcrumb-item active">{{ __('pages.localizations.countries.title') }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')

    <div class="container-fluid">
        {!! $filters !!}

        {!! $table !!}

        {!! $links !!}
    </div>
@endsection
