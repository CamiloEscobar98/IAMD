@php
    $items = $intangibleAssets->groupBy(function ($val) {
        return \Carbon\Carbon::parse($val->created_at)->format('Y');
    });
    
    $labels = [];
    
    $data = [];
    
    foreach ($items as $key => $item) {
        array_push($labels, $key);
        array_push($data, $item->count());
    }
    
    $datasets = [
        [
            'label' => 'Activos Intangibles',
            'data' => $data,
            'backgroundColor' => 'red',
        ],
    ];
    
    $data = [
        'labels' => $labels,
        'datasets' => $datasets,
    ];
    
    $config = json_encode([
        'type' => 'bar',
        'data' => $data,
    ]);
    
    // dd($data);
    
@endphp

<div class="chart text-center">

    <h4 class="mb-4">Gráfica Activos Intangibles por Año</h4>
    <img src="https://quickchart.io/chart?c={{ $config }}" style="width: 100%">

    <div class="page-break"></div>

    <table class="table table-sm table-bordered border-1 mt-4">
        <tbody>
            <tr class="text-center">
                <td colspan="3" class="bg-title text-white font-weight-bold">Información de la Gráfica</td>
            </tr>

            @foreach ($items as $key => $item)
                <tr class="text-center">
                    <td colspan="1" class="bg-subtitle">
                        <small class="font-weight-bold">{{ $key }}</small>
                    </td>
                    <td colspan="2" class="font-weight-bold"><small>{{ $item->count() }} Activos Intangibles
                            registrados.</small></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
