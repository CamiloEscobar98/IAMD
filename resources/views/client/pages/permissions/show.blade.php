@extends('client.layout.app')

@section('title', __('pages.client.permissions.route-titles.show'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.client.permissions.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.permissions.index', $client->name) }}">
                                {{ __('pages.client.permissions.title') }} </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $item->info }}</li>
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
        <p>{!! __('pages.client.permissions.info.show', ['role' => $item->info]) !!}</p>

        <div class="pl-3 py-2 bg-danger text-white">
            <h5 class="font-weight-bold">{{ __('pages.client.permissions.form-titles.show') }}</h5>
        </div>

        <!-- Slug -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.permission_module_id') }}:</label>
            <p>{{ $item->permission_module->name }}</p>
        </div>
        <!-- ./Slug -->

        <!-- Slug -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.slug') }}:</label>
            <p>{{ $item->name }}</p>
        </div>
        <!-- ./Slug -->

        <!-- Info -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.name') }}:</label>
            <p>{{ $item->info }}</p>
        </div>
        <!-- ./Info -->

        <hr>

        <!-- Created At -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.created_at') }}:</label>
            <p>{{ transformTimestampToString($item->created_at) }}</p>
        </div>
        <!-- ./Created At -->

        <!-- Updated At -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.updated_at') }}:</label>
            <p>{{ transformTimestampToString($item->updated_at) }}</p>
        </div>
        <!-- ./Updated At -->

        @can('permissions.update')
            <!-- Edit Button -->
            <div class="form-group mt-3">
                <a href="{{ getClientRoute('client.permissions.edit', [$item->id]) }}"
                    class="btn btn-danger btn-sm">{{ __('buttons.update_to') }}</a>
            </div>
            <!-- Edit Button -->
        @endcan
    </div>
@endsection
