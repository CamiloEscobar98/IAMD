<div class="chart text-center">

    @foreach ($graphicData['with_graphics_assets_classification_per_year'] as $configData)
        @php
            
            $labels = $configData['labels'];
            
            $datasets = $configData['datasets'];
            
            $data = [
                'labels' => $labels,
                'datasets' => $datasets,
            ];
            
            $config = json_encode([
                'type' => 'bar',
                'data' => $data,
            ]);
            
        @endphp

        <h4 class="mb-4">Gráfica Activos Intangibles por Año y por Clasificación</h4>
        <img src="https://quickchart.io/chart?c={{ $config }}" style="width: 100%">
        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
</div>
