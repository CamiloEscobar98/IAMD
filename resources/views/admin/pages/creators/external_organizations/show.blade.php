@extends('admin.layout.app')

@section('title', __('pages.admin.creators.external_organizations.route-titles.show'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.admin.creators.external_organizations.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ __('pages.admin.creators.title') }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.creators.external_organizations.index') }}">
                                {{ __('pages.admin.creators.external_organizations.title') }} </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $item->name }}</li>
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
        <p>{!! __('pages.admin.creators.external_organizations.info.show', ['external_organization' => $item->name]) !!}
        </p>

        <div class="bg-danger text-white pl-3 py-2">
            <h5 class="font-weight-bold">
                {{ __('pages.admin.creators.external_organizations.form-titles.show') }}</h5>
        </div>

        <!-- Nit -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.nit') }}:</label>
            <p>{{ $item->nit }}</p>
        </div>
        <!-- ./Nit -->

        <!-- Name -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.name') }}:</label>
            <p>{{ $item->name }}</p>
        </div>
        <!-- ./Name -->

        <!-- Email -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.email') }}:</label>
            <p>{{ $item->email }}</p>
        </div>
        <!-- ./Email -->

        <!-- Phone -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.telephone') }}:</label>
            <p>{{ getParamObject($item, 'telephone', true) }}</p>
        </div>
        <!-- ./Phone -->

        <!-- Address -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.address') }}:</label>
            <p>{{ getParamObject($item, 'address', true) }}</p>
        </div>
        <!-- ./Address -->

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

        <div class="form-group mt-3">
            <a href="{{ route('admin.creators.external_organizations.edit', $item->id) }}"
                class="btn btn-danger btn-sm">{{ __('buttons.update_to') }}</a>
        </div>
    </div>
@endsection
