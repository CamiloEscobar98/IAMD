@extends('reports.app')

@section('content')
    <table class="table table-sm table-bordered border-1">
        <tbody>
            <tr class="text-center">
                <td colspan="3" class="bg-title text-white font-weight-bold">Reporte Personalizado Activos Intangibles</td>
            </tr>
            <!-- Total -->
            <tr class="text-center">
                <td class="bg-subtitle">
                    <small class="font-weight-bold">Total de Activos:</small>
                </td>
                <td colspan="2" class="font-weight-bold">
                    <small>{{ $intangibleAssets->count() }}/{{ $count }}</small>
                </td>
            </tr>
            <!-- ./Total -->

            <!-- Completed Phases -->
            <tr class="text-center">
                <td colspan="3" class="bg-title text-white font-weight-bold">Fases Completadas</td>
            </tr>

            <!-- Phase 1 Completed -->
            <tr class="text-center">
                <td class="bg-subtitle">
                    <small class="font-weight-bold">Fase 1 Completada:</small>
                </td>
                <td colspan="2" class="font-weight-bold"><small>{{ $phasesCompleted['phaseOneCompleted'] }}
                        Activos Intangibles. Porcentaje:
                        {{ round(($phasesCompleted['phaseOneCompleted'] / $intangibleAssets->count()) * 100) }}%</small>
                </td>
            </tr>
            <!-- ./Phase 1 Completed -->

            <!-- Phase 2 Completed -->
            <tr class="text-center">
                <td class="bg-subtitle">
                    <small class="font-weight-bold">Fase 2 Completada:</small>
                </td>
                <td colspan="2" class="font-weight-bold"><small>{{ $phasesCompleted['phaseTwoCompleted'] }}
                        Activos Intangibles. Porcentaje:
                        {{ round(($phasesCompleted['phaseTwoCompleted'] / $intangibleAssets->count()) * 100) }}%</small>
                </td>
            </tr>
            <!-- ./Phase 2 Completed -->

            <!-- Phase 3 Completed -->
            <tr class="text-center">
                <td class="bg-subtitle">
                    <small class="font-weight-bold">Fase 3 Completada:</small>
                </td>
                <td colspan="2" class="font-weight-bold"><small>{{ $phasesCompleted['phaseThreeCompleted'] }}
                        Activos Intangibles. Porcentaje:
                        {{ round(($phasesCompleted['phaseThreeCompleted'] / $intangibleAssets->count()) * 100) }}%</small>
                </td>
            </tr>
            <!-- ./Phase 3 Completed -->

            <!-- Phase 3 Completed -->
            <tr class="text-center">
                <td class="bg-subtitle">
                    <small class="font-weight-bold">Fase 3 Completada:</small>
                </td>
                <td colspan="2" class="font-weight-bold"><small>{{ $phasesCompleted['phaseThreeCompleted'] }}
                        Activos Intangibles. Porcentaje:
                        {{ round(($phasesCompleted['phaseThreeCompleted'] / $intangibleAssets->count()) * 100) }}%</small>
                </td>
            </tr>
            <!-- ./Phase 3 Completed -->

            <!-- Phase 4 Completed -->
            <tr class="text-center">
                <td class="bg-subtitle">
                    <small class="font-weight-bold">Fase 4 Completada:</small>
                </td>
                <td colspan="2" class="font-weight-bold"><small>{{ $phasesCompleted['phaseFourCompleted'] }}
                        Activos Intangibles. Porcentaje:
                        {{ round(($phasesCompleted['phaseFourCompleted'] / $intangibleAssets->count()) * 100) }}%</small>
                </td>
            </tr>
            <!-- ./Phase 4 Completed -->

            <!-- Phase 5 Completed -->
            <tr class="text-center">
                <td class="bg-subtitle">
                    <small class="font-weight-bold">Fase 5 Completada:</small>
                </td>
                <td colspan="2" class="font-weight-bold"><small>{{ $phasesCompleted['phaseFiveCompleted'] }}
                        Activos Intangibles. Porcentaje:
                        {{ round(($phasesCompleted['phaseFiveCompleted'] / $intangibleAssets->count()) * 100) }}%</small>
                </td>
            </tr>
            <!-- ./Phase 5 Completed -->

            <!-- Phase 6 Completed -->
            <tr class="text-center">
                <td class="bg-subtitle">
                    <small class="font-weight-bold">Fase 6 Completada:</small>
                </td>
                <td colspan="2" class="font-weight-bold"><small>{{ $phasesCompleted['phaseSixCompleted'] }}
                        Activos Intangibles. Porcentaje:
                        {{ round(($phasesCompleted['phaseSixCompleted'] / $intangibleAssets->count()) * 100) }}%</small>
                </td>
            </tr>
            <!-- ./Phase 6 Completed -->

            <!-- Phase 7 Completed -->
            <tr class="text-center">
                <td class="bg-subtitle">
                    <small class="font-weight-bold">Fase 7 Completada:</small>
                </td>
                <td colspan="2" class="font-weight-bold"><small>{{ $phasesCompleted['phaseSevenCompleted'] }}
                        Activos Intangibles. Porcentaje:
                        {{ round(($phasesCompleted['phaseSevenCompleted'] / $intangibleAssets->count()) * 100) }}%</small>
                </td>
            </tr>
            <!-- ./Phase 7 Completed -->

            <!-- Phase 8 Completed -->
            <tr class="text-center">
                <td class="bg-subtitle">
                    <small class="font-weight-bold">Fase 8 Completada:</small>
                </td>
                <td colspan="2" class="font-weight-bold"><small>{{ $phasesCompleted['phaseEightCompleted'] }}
                        Activos Intangibles. Porcentaje:
                        {{ round(($phasesCompleted['phaseEightCompleted'] / $intangibleAssets->count()) * 100) }}%</small>
                </td>
            </tr>
            <!-- ./Phase 8 Completed -->

            <!-- Phase 9 Completed -->
            <tr class="text-center">
                <td class="bg-subtitle">
                    <small class="font-weight-bold">Fase 9 Completada:</small>
                </td>
                <td colspan="2" class="font-weight-bold"><small>{{ $phasesCompleted['phaseNineCompleted'] }}
                        Activos Intangibles. Porcentaje:
                        {{ round(($phasesCompleted['phaseNineCompleted'] / $intangibleAssets->count()) * 100) }}%</small>
                </td>
            </tr>
            <!-- ./Phase 9 Completed -->

            <!-- All Phases Completed -->
            <tr class="text-center">
                <td class="bg-subtitle">
                    <small class="font-weight-bold">Todas las Fases Completadas:</small>
                </td>
                <td colspan="2" class="font-weight-bold"><small>{{ $phasesCompleted['allPhasesCompleted'] }}
                        Activos Intangibles. Porcentaje:
                        {{ round(($phasesCompleted['allPhasesCompleted'] / $intangibleAssets->count()) * 100) }}%</small>
                </td>
            </tr>
            <!-- ./All Phases Completed -->
            <!-- ./Completed Phases -->

            <!-- -->
        </tbody>
    </table>


    @if (!empty($contentConfiguration))
        <div class="page-break"></div>

        <!-- Items -->
        @foreach ($intangibleAssets as $intangibleAsset)
            @include('reports.intangible_assets.components.asset', [
                'intangibleAsset' => $intangibleAsset,
                'contentConfiguration' => $contentConfiguration,
            ])
            <div class="page-break"></div>
        @endforeach
        <!-- ./Items -->
    @endif
@endsection
