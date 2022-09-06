@extends('admin.layout.app')

@section('title', __('pages.admin.intangible_assets.states.title'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.admin.intangible_assets.states.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('pages.admin.home.title') }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ __('pages.admin.intangible_assets.title') }}</li>
                        <li class="breadcrumb-item active">{{ __('pages.admin.intangible_assets.states.title') }}</li>
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


@section('custom_js')
    @include('messages.delete_item', ['title' => __('pages.admin.intangible_assets.states.messages.confirm')])
@endsection
