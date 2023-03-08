@extends('client.layout.app')

@section('title', __('pages.client.intangible_assets.route-titles.edit'))

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
                    <h1>{{ __('pages.client.intangible_assets.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.intangible_assets.index', $client->name) }}">
                                {{ __('pages.client.intangible_assets.title') }} </a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{ getClientRoute('client.intangible_assets.show', [$item->id]) }}">{{ $item->name }}</a>
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

        <h3 class="font-italic font-weight-bold">
            <u>{{ __('pages.default.title-information') }}</u>
        </h3>
        <p>{!! __('pages.client.intangible_assets.info.edit', ['intangible_asset' => $item->name]) !!}</p>

        <div class="card">
            <div class="card-header bg-danger">
                <h5 class="font-weight-bold">{{ __('pages.client.intangible_assets.form-titles.edit') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ getClientRoute('client.intangible_assets.update', [$item->id]) }}" method="post"
                    data-client="{{ $client->name }}" id="form">
                    @csrf
                    @method('PUT')

                    @include('client.pages.intangible_assets.components.form')

                    <!-- Button Save -->
                    <div class="form-group mt-3">
                        <button class="btn btn-danger btn-sm">{{ __('buttons.update') }}</button>
                    </div>
                    <!-- ./Button Save -->

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
    {{-- <script src="{{ asset('adminlte/dist/js/iamd/projects.js') }}"></script> --}}

    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('#research_unit_id').select2({
            theme: 'bootstrap4',
            placeholder: '---Seleccionar Unidades Investigativas'
        })
    </script>

    <script>
        function changeProjectSelect() {
            let projectId = $('#project_id').val();

            getResearchUnits(projectId)
        }

        function getResearchUnits(projectId) {
            let client = $('#form').data('client');

            $.ajax({
                type: 'GET',
                url: "/api/" + client + "/unidades-investigativas/",
                data: 'project_id=' + projectId
            }).done(function(res) {
                if (Array.isArray(res) && res.length > 0) {
                    putResearchUnits(res);
                } else {
                    putResearchUnits([]);
                }
            });
        }

        function putResearchUnits(items) {
            let selectResearchUnit = $('#research_unit_id');

            selectResearchUnit.empty();

            selectResearchUnit.append(`<option value="">---Seleccionar Unidad Investigativa</option>`);

            let isSelected = '';

            items.forEach((item, index) => {
                var id = item['id'];
                var name = item['name'];

                selectResearchUnit.append(`<option value="${id}" ${isSelected}>${name}</option>`);

            });
        }
    </script>
@endsection
