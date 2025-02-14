@extends('client.layout.app')

@section('title', __('pages.client.projects.route-titles.show'))

@section('content-header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('pages.client.projects.subtitle') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('client.home', $client->name) }}">{{ __('pages.default.home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('client.projects.index', $client->name) }}">
                                {{ __('pages.client.projects.title') }} </a>
                        </li>
                        <li class="breadcrumb-item">{{ $item->name }}</li>
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
        <p>{!! __('pages.client.projects.info.show', ['project' => $item->name]) !!}</p>

        <div class="pl-3 py-2 bg-danger text-white">
            <h5 class="font-weight-bold">{{ __('pages.client.projects.form-titles.show') }}</h5>
        </div>

        <!-- Name -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.project_name') }}:</label>
            <p>{{ $item->name }}</p>
        </div>
        <!-- ./Name -->

        <!-- Research Unit -->
        <div class="form-group mt-3">
            <label>Unidades de Investigación:</label>
            <p>
                @foreach ($item->research_units as $researchUnitItem)
                    <a href="{{ getClientRoute('client.research_units.show', [$researchUnitItem->id]) }}"
                        class="btn btn-sm btn-outline-secondary">{{ $researchUnitItem->name }}</a>
                @endforeach
            </p>
        </div>
        <!-- ./Research Unit -->

        <!-- Directror -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.director_id') }}:</label>
            <p>
                <a href="{{ getClientRoute('client.' . $item->director->creator_type_route . '.show', [$item->director->id]) }}"
                    class="btn btn-sm btn-outline-secondary">{{ getParamObject($item->director, 'name') }}</a>
            </p>
        </div>
        <!-- ./Directror -->

        <!-- Description -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.description') }}:</label>
            <p>{{ $item->description }}</p>
        </div>
        <!-- ./Description -->

        <hr>

        <!-- Financing Types -->

        <div class="form-group mt-3">
            <label>{{ __('inputs.financing_type_id') }}</label>
            <p>
                @foreach ($item->project_financings as $projectFinancingItem)
                    <a href="{{ getClientRoute('client.financing_types.show', [$projectFinancingItem->id]) }}"
                        class="btn btn-sm btn-outline-secondary">{{ $projectFinancingItem->name }}</a>
                @endforeach
            </p>
        </div>
        <!-- ./Financing Types -->

        <hr>

        <!-- Project Contract Types -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.project_contract_type_id') }}</label>
            <p> <a href="{{ getClientRoute('client.project_contract_types.show', [$item->contract_type->id]) }}"
                    class="btn btn-sm btn-outline-secondary">{{ $item->contract_type->name }}</a>
            </p>
        </div>
        <!-- ./Project Contract Types -->

        <!-- Contract -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.contract') }}</label>
            <p>{{ $item->contract }}</p>
        </div>
        <!-- ./Contract -->

        <!-- Contract Date -->
        <div class="form-group mt-3">
            <label>{{ __('inputs.contract_date') }}</label>
            <p>{{ transformDatetoString($item->date) }}</p>
        </div>
        <!-- ./Contract Date -->

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


        @if (role_can_permission('projects.update'))
            <!-- Edit Button -->
            <div class="form-group mt-3">
                <a href="{{ getClientRoute('client.projects.edit', [$item->id]) }}"
                    class="btn btn-danger btn-sm">{{ __('buttons.update_to') }}</a>
            </div>
            <!-- Edit Button -->
        @endif

        @include('client.pages.projects.components.table_intangible_assets')
    </div>
@endsection

@section('custom_js')
    @include('messages.delete_item', [
        'title' => __('pages.client.intangible_assets.messages.confirm'),
    ])

    <script>
        $('#research_unit_id').select2({
            theme: 'bootstrap4',
            placeholder: '--Seleccionar las unidades de investigación',
            allowClear: true
        })

        $('#financing_type_id').select2({
            theme: 'bootstrap4',
            placeholder: '--Seleccionar las unidades de investigación',
            allowClear: true
        })
    </script>
@endsection
