@extends('client.layout.app')

@section('title', __('pages.default.home'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.client.home.subtitle') }}</h1>
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

        <h5 class="font-weight-bold">{{ __('pages.client.home.main') }}</h5>

        <hr>

        <div class="row">

            <!-- Users Card -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-users"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.users.title') }}</h5>
                            @can('users.index')
                                <a class="text-white fas fa-angle-double-right"
                                    href="{{ getClientRoute('client.users.index') }}"></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.client.users.info.callout', ['count' => $userCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Users Card -->

            <!-- Internal Creators Card -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-user-friends"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.creators.internal.title') }}</h5>
                            @can('creators.internal.index')
                                <a class="text-white fas fa-angle-double-right"
                                    href="{{ getClientRoute('client.creators.internal.index') }}"></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.client.creators.internal.info.callout', ['count' => $creatorInternalCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Internal Creators Card -->

            <!-- External Creators Card -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-user-tie"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.creators.external.title') }}</h5>
                            @can('creators.external.index')
                                <a class="text-white fas fa-angle-double-right"
                                    href="{{ getClientRoute('client.creators.external.index') }}"></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.client.creators.external.info.callout', ['count' => $creatorExternalCount]) !!}
                    </div>
                </div>
            </div>
            <!-- External Creators Card -->

            <!-- Academic Departments Card -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-globe"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.academic_departments.title') }}</h5>
                            @can('academic_departments.index')
                                <a class="text-white fas fa-angle-double-right"
                                    href="{{ getClientRoute('client.academic_departments.index') }}"></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.client.academic_departments.info.callout', ['count' => $academicDepartmentCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Academic Departments Card -->
        </div>

        <div class="row">

            <!-- Administrative Units Card -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-university"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.administrative_units.title') }}</h5>
                            @can('administrative_units.index')
                                <a class="text-white fas fa-angle-double-right"
                                    href="{{ getClientRoute('client.administrative_units.index') }}"></a>
                            @endcan
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
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-microscope"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.research_units.title') }}</h5>
                            @can('research_units.index')
                                <a class="text-white fas fa-angle-double-right"
                                    href="{{ getClientRoute('client.research_units.index') }}"></a>
                            @endcan
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
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.projects.title') }}</h5>
                            @can('projects.index')
                                <a class="text-white fas fa-angle-double-right"
                                    href="{{ getClientRoute('client.projects.index') }}"></a>
                            @endcan
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
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-archive"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.intangible_assets.title') }}</h5>
                            @can('intangible_assets.index')
                                <a class="text-white fas fa-angle-double-right"
                                    href="{{ getClientRoute('client.intangible_assets.index') }}"></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.client.intangible_assets.info.callout', ['count' => $intangibleAssetCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Intangible Assets Card -->

        </div>

        <hr>

        <h5 class="font-weight-bold">{{ __('pages.client.home.config') }}</h5>

        <hr>

        <div class="row">

            <!-- Strategy Categories Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-star"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.strategy_categories.title') }}</h5>
                            @can('strategy_categories.index')
                                <a class="text-white fas fa-angle-double-right"
                                    href="{{ getClientRoute('client.strategy_categories.index') }}"></a>
                            @endcan
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
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-toolbox"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.strategies.title') }}</h5>
                            @can('strategies.index')
                                <a class="text-white fas fa-angle-double-right"
                                    href="{{ getClientRoute('client.strategies.index') }}"></a>
                            @endcan
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
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-balance-scale"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.financing_types.title') }}</h5>
                            @can('financing_types.index')
                                <a class="text-white fas fa-angle-double-right"
                                    href="{{ getClientRoute('client.financing_types.index') }}"></a>
                            @endcan
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

            <!-- Priority Tools Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-tools"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.priority_tools.title') }}</h5>
                            @can('priority_tools.index')
                                <a class="text-white fas fa-angle-double-right"
                                    href="{{ getClientRoute('client.priority_tools.index') }}"></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.client.priority_tools.info.callout', ['count' => $priorityToolCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Priority Tools Card -->

            <!-- Secret Protection Measures Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-user-secret"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.secret_protection_measures.title') }}</h5>
                            @can('secret_protection_measures.index')
                                <a class="text-white fas fa-angle-double-right"
                                    href="{{ getClientRoute('client.secret_protection_measures.index') }}"></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.client.secret_protection_measures.info.callout', ['count' => $secretProtectionMeasureCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Secret Protection Measures Card -->

            <!-- Project Contract Types Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-danger py-2">
                        <div class="row justify-content-between">
                            <i class="fas fa-hands-helping"></i>
                            <h5 class="font-weight-bold">{{ __('pages.client.project_contract_types.title') }}</h5>
                            @can('project_contract_types.index')
                                <a class="text-white fas fa-angle-double-right"
                                    href="{{ getClientRoute('client.project_contract_types.index') }}"></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        {!! __('pages.client.project_contract_types.info.callout', ['count' => $financingTypeCount]) !!}
                    </div>
                </div>
            </div>
            <!-- Project Contract Types Card -->

        </div>

    </div>
@endsection
