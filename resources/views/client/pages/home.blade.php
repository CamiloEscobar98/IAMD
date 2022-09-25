@extends('client.layout.app')

@section('title', __('pages.client.home.title'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.client.home.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">{{ __('pages.client.home.title') }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')

    <div class="container-fluid">

        <h3>{{ __('pages.client.home.main') }}</h3>

        <hr>

        <div class="row">

            <!-- Users Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-gradient-secondary py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-university"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.users.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ getClientRoute('client.users.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.client.users.info.callout', ['count' => $userCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Users Card -->

            <!-- Internal Creators Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-gradient-secondary py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-university"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.creators.internal.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ getClientRoute('client.creators.internal.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.client.creators.internal.info.callout', ['count' => $creatorInternalCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Administrative Units Card -->


            <!-- Administrative Units Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-gradient-secondary py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-university"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.creators.external.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ getClientRoute('client.creators.external.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.client.creators.external.info.callout', ['count' => $creatorExternalCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Administrative Units Card -->
        </div>

        <div class="row">

            <!-- Administrative Units Card -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header bg-gradient-secondary py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-university"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.administrative_units.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ getClientRoute('client.administrative_units.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.client.administrative_units.info.callout', ['count' => $administrativeUnitCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Administrative Units Card -->

            <!-- Research Units Card -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header bg-gradient-success py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-university"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.research_units.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ getClientRoute('client.research_units.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.client.research_units.info.callout', ['count' => $researchUnitCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Research Units Card -->

            <!-- Projects Card -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header bg-gradient-primary py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-university"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.projects.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ getClientRoute('client.projects.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.client.projects.info.callout', ['count' => $projectCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Projects Card -->

            <!-- Intangible Assets Card -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header bg-gradient-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-university"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.intangible_assets.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ getClientRoute('client.intangible_assets.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.client.intangible_assets.info.callout', ['count' => $intangibleAssetCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Intangible Assets Card -->

        </div>

        <h3>{{ __('pages.client.home.config') }}</h3>

        <hr>

        <div class="row">

            <!-- Strategy Categories Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-gradient-warning py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-university"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.strategy_categories.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ getClientRoute('client.strategy_categories.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.client.strategy_categories.info.callout', ['count' => $strategyCategoryCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Strategy Categories Card -->

            <!-- Strategies Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-warning py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-university"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.strategies.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ getClientRoute('client.strategies.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.client.strategies.info.callout', ['count' => $strategyCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Strategies Card -->

            <!-- Financing Projects Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-gradient-info py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-university"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.financing_types.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ getClientRoute('client.financing_types.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.client.financing_types.info.callout', ['count' => $financingTypeCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Financing Projects Card -->

        </div>

        <div class="row">

            <!-- Strategy Categories Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-success py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-university"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.priority_tools.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ getClientRoute('client.priority_tools.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.client.priority_tools.info.callout', ['count' => $priorityToolCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Strategy Categories Card -->

            <!-- Strategies Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-warning py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-university"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.secret_protection_measures.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ getClientRoute('client.secret_protection_measures.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.client.secret_protection_measures.info.callout', ['count' => $secretProtectionMeasureCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Strategies Card -->

            <!-- Financing Projects Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-gradient-info py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-university"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.financing_types.title') }}</h5>
                            <a class="text-white fas fa-angle-double-right"
                                href="{{ getClientRoute('client.financing_types.index') }}"></a>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.client.financing_types.info.callout', ['count' => $financingTypeCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Financing Projects Card -->

        </div>

    </div>
@endsection
