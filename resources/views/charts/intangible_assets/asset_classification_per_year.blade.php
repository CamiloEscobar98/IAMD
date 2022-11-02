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

        <h4 class="mb-4">Gráfica Activos Intangibles por Año</h4>
        <img src="https://quickchart.io/chart?c={{ $config }}" style="width: 100%">
        <div class="page-break"></div>
    @endforeach

    <table class="table table-sm table-bordered border-1 mt-4">
        <tbody>
            <tr class="text-center">
                <td colspan="3" class="bg-title text-white font-weight-bold">Información de la Gráfica: Activos
                    Intangibles por Año</td>
            </tr>

            {{-- @foreach ($items as $key => $item)
                <tr class="text-center">
                    <td colspan="1" class="bg-subtitle">
                        <small class="font-weight-bold">{{ $key }}</small>
                    </td>
                    <td colspan="2" class="font-weight-bold"><small>{{ $item->count() }} Activos Intangibles
                            registrados.</small></td>
                </tr>
            @endforeach --}}
        </tbody>
    </table>
</div>
