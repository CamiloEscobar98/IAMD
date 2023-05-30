@extends('client.layout.app')

@section('title', __('pages.client.users.route-titles.edit'))

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
                    <h1>{{ __('pages.client.users.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.users.index', $client->name) }}">
                                {{ __('pages.client.users.title') }} </a>
                        </li>
                        <li class="breadcrumb-item">{{ $item->name }}</li>
                        <li class="breadcrumb-item active">{{ __('pages.default.edit') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="container-fluid">
        <h3 class="font-weight-bold">
            <u>{{ __('pages.default.title-information') }}</u>
        </h3>
        <p>{!! __('pages.client.users.info.edit', ['user' => $item->name]) !!}</p>
        <div class="card">
            <div class="card-header bg-danger">
                <h5 class="font-weight-bold">{{ __('pages.client.users.form-titles.edit') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ getClientRoute('client.users.update', [$item->id]) }}" method="post">
                    @csrf
                    @method('PUT')

                    @include('client.pages.users.components.form')

                    <div class="form-group mt-3">
                        <button class="btn btn-danger btn-sm">{{ __('buttons.update') }}</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection

@section('custom_js')
    <script>
        //Initialize Select2 Elements
        $('#role_id').select2({
            theme: 'bootstrap4',
            placeholder: '--Seleccionar roles del usuario',
            allowClear: true
        })
    </script>
@endsection
