@php
    
    $collection = collect($graphicData['with_graphics_assets_per_year']);
    
    $dataConfig = $collection->only(['type', 'data'])->toJson();
    
@endphp

<div class="chart text-center">

    <h4 class="mb-4">Gráfica Activos Intangibles por Año</h4>
    <img src="https://quickchart.io/chart?c={{ $dataConfig }}" style="width: 100%">

    <div class="page-break"></div>

    <table class="table table-sm table-bordered border-1 mt-4">
        <tbody>
            <tr class="text-center">
                <td colspan="3" class="bg-title text-white font-weight-bold">Información de la Gráfica: Activos
                    Intangibles por Año</td>
            </tr>

            @foreach ($graphicData['with_graphics_assets_per_year']['items'] as $key => $item)
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
