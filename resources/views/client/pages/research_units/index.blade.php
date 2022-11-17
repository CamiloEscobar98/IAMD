@extends('client.layout.app')

@section('title', __('pages.client.research_units.title'))

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
                    <h1>{{ __('pages.client.research_units.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('pages.client.research_units.title') }}</li>
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
@endsection

@section('js')
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection

@section('custom_js')
    @include('messages.delete_item', ['title' => __('pages.client.research_units.messages.confirm')])

    <script>
        // Administrative Units filter
        $('.administrative_units').select2({
            theme: 'bootstrap4',
            placeholder: "{{ __('pages.client.research_units.filters.administrative_units') }}"
        });

        $('.research_unit_categories').select2({
            theme: 'bootstrap4',
            placeholder: "{{ __('pages.client.research_units.filters.research_unit_categories') }}"
        });

        $('.directors').select2({
            theme: 'bootstrap4',
            placeholder: "{{ __('pages.client.research_units.filters.directors') }}"
        });

        $('.inventory_managers').select2({
            theme: 'bootstrap4',
            placeholder: "{{ __('pages.client.research_units.filters.inventory_managers') }}"
        });
    </script>
@endsection
