@extends('admin.layout.app')

@section('title', __('pages.admin.intellectual_property_rights.products.route-titles.show'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.admin.intellectual_property_rights.products.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ __('pages.admin.intellectual_property_rights.title') }}</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.intellectual_property_rights.products.index') }}">
                                {{ __('pages.admin.intellectual_property_rights.products.title') }} </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $item->name }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h3 class="font-italic font-weight-bold">
                    <u>{{ __('pages.default.title-information') }}</u>
                </h3>
                <p>{!! __('pages.admin.intellectual_property_rights.products.info.show', [
                    'product' => $item->name,
                    'states_count' => $item->states_count,
                    'cities_count' => $item->cities_count,
                ]) !!}
                </p>
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center font-weight-bold">
                            <u>{{ __('pages.admin.intellectual_property_rights.products.form-titles.show') }}</u>
                        </h3>

                        <!-- Intellectual Property Rights Categories -->
                        <div class="input-group mt-3">
                            <input type="text" name="name" class="form-control" placeholder="{{ __('inputs.name') }}"
                                value="{{ $item->intellectual_property_right_subcategory->intellectual_property_right_category->name }}"
                                disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-star"></span>
                                </div>
                            </div>
                        </div>

                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <!-- ./Intellectual Property Rights Categories -->

                        <!-- Intellectual Property Rights Subcategories -->
                        <div class="input-group mt-3">
                            <input type="text" name="name" class="form-control" placeholder="{{ __('inputs.name') }}"
                                value="{{ $item->intellectual_property_right_subcategory->name }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-square"></span>
                                </div>
                            </div>
                        </div>

                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <!-- ./Intellectual Property Rights Subcategories -->

                        <!-- Name -->
                        <div class="input-group mt-3">
                            <input type="text" name="name" class="form-control" placeholder="{{ __('inputs.name') }}"
                                value="{{ $item->name }}" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-circle"></span>
                                </div>
                            </div>
                        </div>

                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <!-- ./Name -->

                        <div class="form-group mt-3">
                            <a href="{{ route('admin.intellectual_property_rights.products.edit', $item->id) }}"
                                class="btn btn-warning btn-sm">{{ __('buttons.update_to') }}</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('custom_js')
    @include('messages.delete_item', ['title' => __('pages.admin.localizations.states.messages.confirm')])
@endsection
