@extends('admin.layout.app')

@section('title', __('admin_pages.creators.document_types.title'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('admin_pages.creators.document_types.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('admin_pages.home.title') }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ __('admin_pages.localizations.title') }}</li>
                        <li class="breadcrumb-item active">{{ __('admin_pages.creators.document_types.title') }}</li>
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
    @include('messages.delete_item', ['title' => __('admin_pages.creators.document_types.messages.confirm')])
@endsection
