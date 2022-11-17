@extends('client.layout.app')

@section('title', __('pages.client.projects.title'))

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.client.projects.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('pages.client.projects.title') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')

    <div class="container-fluid">
        {!! $filters !!}

        {!! $table !!}
    </div>

    <div class="container-fluid">
        <div class="mt-4">
            {!! $links !!}
        </div>
    </div>
@endsection

@section('js')
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection

@section('custom_js')
    @include('messages.delete_item', ['title' => __('pages.client.projects.messages.confirm')])

    <script src="{{ asset('adminlte/dist/js/iamd/projects.js') }}"></script>

    <script>
        // Administrative Units
        $('.administrative_units').select2({
            theme: 'bootstrap4',
            placeholder: "{{ __('pages.client.projects.filters.administrative_units') }}"
        });

        // Research Units
        $('.research_units').select2({
            theme: 'bootstrap4',
            placeholder: "{{ __('pages.client.projects.filters.research_units') }}",
            allowClear: true
        })
    </script>
@endsection
