@extends('admin.layout.app')

@section('title', __('pages.default.home'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.admin.home.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">{{ __('pages.default.home') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')

    <div class="container-fluid">

        <hr>

        <h5 class="font-weight-bold">{{ __('pages.admin.home.localizations') }}</h5>

        <hr>

        <div class="row">

            <!-- Countries Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-flag"></i>
                            <h5 class="font-weight-bold">{{ __('pages.admin.localizations.countries.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ route('admin.localizations.countries.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.admin.localizations.countries.info.callout', ['count' => $countryCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Countries Card -->

            <!-- States Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-building"></i>
                            <h5 class="font-weight-bold">{{ __('pages.admin.localizations.states.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ route('admin.localizations.states.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.admin.localizations.states.info.callout', ['count' => $stateCount]) !!}
                    </div>
                </div>
            </div>
            <!-- States Card -->


            <!-- Cities Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-city"></i>
                            <h5 class="font-weight-bold">{{ __('pages.admin.localizations.cities.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ route('admin.localizations.cities.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.admin.localizations.cities.info.callout', ['count' => $cityCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Cities Card -->
        </div>

        <hr>

        <h5 class="font-weight-bold">{{ __('pages.admin.home.creators') }}</h5>

        <hr>

        <div class="row">

            <!-- Document Types Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-id-card"></i>
                            <h5 class="font-weight-bold">{{ __('pages.admin.creators.document_types.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ route('admin.creators.document_types.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.admin.creators.document_types.info.callout', ['count' => $documentTypeCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Document Types Card -->

            <!-- External Organizations Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-industry"></i>
                            <h5 class="font-weight-bold">{{ __('pages.admin.creators.external_organizations.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ route('admin.creators.external_organizations.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.admin.creators.external_organizations.info.callout', ['count' => $externalOrganizationCount]) !!}
                    </div>
                </div>
            </div>
            <!-- External Organizations Card -->

            <!-- Assignment Contracts Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-user-tie"></i>
                            <h5 class="font-weight-bold">{{ __('pages.admin.creators.assignment_contracts.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ route('admin.creators.assignment_contracts.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.admin.creators.assignment_contracts.info.callout', ['count' => $assignmentContractCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Assignment Contracts Card -->
        </div>

        <hr>

        <h5 class="font-weight-bold">{{ __('pages.admin.home.intangible_assets') }}</h5>

        <hr>

        <div class="row">
            <!-- Intangible Assets Card -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-battery-half"></i>
                            <h5 class="font-weight-bold">{{ __('pages.admin.intangible_assets.states.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ route('admin.intangible_assets.status.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.admin.intangible_assets.states.info.callout', ['count' => $intangibleAssetStateCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Intangible Assets Card -->
        </div>

        <hr>

        <h5 class="font-weight-bold">{{ __('pages.admin.home.dpis') }}</h5>

        <hr>

        <div class="row">

            <!-- Intellectual Property Right Categories Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-star"></i>
                            <h5 class="font-weight-bold">
                                {{ __('pages.admin.intellectual_property_rights.categories.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ route('admin.intellectual_property_rights.categories.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.admin.intellectual_property_rights.categories.info.callout', ['count' => $categoryCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Intellectual Property Right Categories Card -->

            <!-- Intellectual Property Right Subcategories Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-square"></i>
                            <h5 class="font-weight-bold">
                                {{ __('pages.admin.intellectual_property_rights.subcategories.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ route('admin.intellectual_property_rights.subcategories.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.admin.intellectual_property_rights.subcategories.info.callout', ['count' => $subcategoryCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Intellectual Property Right Subcategories Card -->

            <!-- Intellectual Property Right Products Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-circle"></i>
                            <h5 class="font-weight-bold">{{ __('pages.admin.intellectual_property_rights.products.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ route('admin.intellectual_property_rights.products.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.admin.intellectual_property_rights.products.info.callout', ['count' => $productCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Intellectual Property Right Products Card -->

        </div>

    </div>
@endsection
