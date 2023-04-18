@php
    $collection = $graphicData['with_graphics_assets_classification_per_research_unit'];
@endphp

<div class="chart text-center">

    @foreach ($collection as $item)
        @php
            $item = collect($item);
            $dataConfig = $item->only(['type', 'data'])->toJson();
        @endphp
        <h4 class="mb-4">Gráfica Tipos de Activos Intangibles por Grupo de Investigación </h4>
        <img src="https://quickchart.io/chart?c={{ $dataConfig }}" style="width: 100%">

        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
</div>
