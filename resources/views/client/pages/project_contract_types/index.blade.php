@extends('client.layout.app')

@section('title', __('pages.client.project_contract_types.title'))

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
                    <h1>{{ __('pages.client.project_contract_types.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.client.home.title') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('pages.client.project_contract_types.title') }}</li>
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
    </div>
@endsection

@section('js')
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection

@section('custom_js')
    @include('messages.delete_item', ['title' => __('pages.client.project_contract_types.messages.confirm')])

    <script>
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection
