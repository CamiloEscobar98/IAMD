@php
    $collection = $graphicData['with_graphics_assets_research_unit_per_administrative_unit'];
    
    $dataConfig = collect($collection)
        ->only(['type', 'data'])
        ->toJson();
@endphp

<div class="chart text-center">

    <h4 class="mb-4">Gráfica Activos Intangibles por Unidades Investigativas</h4>
    <img src="https://quickchart.io/chart?c={{ $dataConfig }}"style="width: 100%">
</div>
