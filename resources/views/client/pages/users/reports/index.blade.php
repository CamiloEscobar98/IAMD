@extends('client.layout.app')

@section('title', __('pages.client.users.reports.title'))

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
                    <h1>{{ __('pages.client.users.reports.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.client.home.title') }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ __('pages.client.users.reports.title') }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')

    <div class="container-fluid">
        <table class="table table-sm table-bordered">
            <thead class="bg-gradient-danger">
                <tr class="text-center">
                    <th>Reporte</th>
                    <th>Fecha</th>
                    <th>Descargar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                    <tr class="text-center">
                        <td>{{ $report->file_name }}</td>
                        <td>{{ $report->created_at }}</td>
                        <td> <a href="{{ route('client.reports.download.report', [$client->name, $report->id]) }}"
                                class="fa-lg fas fa-save"></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('js')
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
@endsection

@section('custom_js')
    @include('messages.delete_item', ['title' => __('pages.client.users.reports.messages.confirm')])

    <script>
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection
