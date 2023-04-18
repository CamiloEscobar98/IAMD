@php
    $collection = $graphicData['with_graphics_assets_classification_per_administrative_unit'];
@endphp

<div class="chart text-center">

    @foreach ($collection as $item)
        @php
            $itemCollection = collect($item);
            $dataConfig = $itemCollection->only(['type', 'data'])->toJson();
        @endphp
        <h4 class="mb-4">Gráfica Activos Intangibles por Clasificación - {!! $item['data']['title'] !!}</h4>
        <img src="https://quickchart.io/chart?c={{ $dataConfig }}"style="width: 100%">

        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
</div>
