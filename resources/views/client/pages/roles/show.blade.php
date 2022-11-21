@extends('client.layout.app')

@section('title', __('pages.client.roles.route-titles.show'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.client.roles.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.roles.index', $client->name) }}">
                                {{ __('pages.client.roles.title') }} </a>
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
        <p>{!! __('pages.client.roles.info.show', ['role' => $item->info]) !!}</p>

        <div class="pl-3 py-2 bg-danger text-white">
            <h5 class="font-weight-bold">{{ __('pages.client.roles.form-titles.show') }}</h5>
        </div>

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

        @can('roles.update')
            <!-- Edit Button -->
            <div class="form-group mt-3">
                <a href="{{ getClientRoute('client.roles.edit', [$item->id]) }}"
                    class="btn btn-danger btn-sm">{{ __('buttons.update_to') }}</a>
            </div>
            <!-- Edit Button -->
        @endcan

        <div class="pl-3 py-2 bg-danger text-white">
            <h5 class="font-weight-bold">{{ __('pages.client.roles.form-titles.permissions') }}</h5>
        </div>

        <form action="{{ getClientRoute('client.roles.update_permissions', [$item->id]) }}" method="post">
            @csrf
            @method('PUT')

            <div class="row">
                @foreach ($permissionModules as $permissionModule)
                    <div class="col-lg-3">
                        <div class="form-group mt-3">
                            <label>{{ $permissionModule->name }}:</label>
                            @foreach ($permissionModule->permissions as $permission)
                                <div class="custom-control custom-checkbox my-1">
                                    <input type="checkbox" class="custom-control-input"
                                        id="permission_{{ $permission->id }}" name="permissions[]"
                                        value="{{ $permission->id }}"
                                        {{ optionInArrayIsChecked($item->permissions, $permission->id) }}>
                                    <label class="custom-control-label font-weight-normal"
                                        for="permission_{{ $permission->id }}">{{ $permission->info }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <button class="btn btn-danger btn-sm">{{ __('buttons.update') }}</button>
            </div>
        </form>
    </div>
@endsection
