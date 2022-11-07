<div class="chart text-center">
    @php
        
        $configData = $graphicData['with_graphics_assets_state_per_year'];
        
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

    <h4 class="mb-4">Gráfica Activos Intangibles por Año y por Estado de Protección</h4>
    <img src="https://quickchart.io/chart?c={{ $config }}" style="width: 100%">
</div>
