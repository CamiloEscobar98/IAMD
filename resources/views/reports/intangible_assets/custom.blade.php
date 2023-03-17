@extends('reports.app')

@section('content')
    @if (hasContent($graphicConfiguration, 'with_graphics_assets_per_year'))
        <!-- Graphics Assets per Year -->
        @include('charts.intangible_assets.assets_per_year', compact('graphicData'))
        <div class="page-break"></div>
    @endif

    @if (hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_year'))
        <!-- Graphics Assets per Year -->
        @include('charts.intangible_assets.asset_classification_per_year', compact('graphicData'))
        <div class="page-break"></div>
    @endif

    @if (hasContent($graphicConfiguration, 'with_graphics_assets_state_per_year'))
        <!-- Graphics Assets per Year -->
        @include('charts.intangible_assets.asset_state_per_year', compact('graphicData'))
        <div class="page-break"></div>
    @endif

    @if (hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_administrative_unit'))
        <!-- Graphics Assets per Year -->
        @include(
            'charts.intangible_assets.asset_classification_per_administrative_unit',
            compact('graphicData'))
        <div class="page-break"></div>
    @endif

    @if (hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_research_unit'))
        <!-- Graphics Assets per Year -->
        @include('charts.intangible_assets.asset_classification_per_research_unit', compact('graphicData'))
    @endif
@endsection


@section('js')
    @if (hasGraphics($graphicConfiguration))
        <script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
    @endif
@endsection
