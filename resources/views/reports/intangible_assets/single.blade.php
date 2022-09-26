@extends('reports.app')

@section('content')
    <table class="table table-sm table-bordered border-1 mt-4">
        <tbody>
            <tr class="text-center">
                <td colspan="3" class="bg-title text-white font-weight-bold">Reporte Individual: Activo Intangible</td>
            </tr>
            <tr class="text-center">
                <td class="bg-subtitle">
                    <small class="font-weight-bold">Nombre del Activo Intangible:</small>
                </td>
                <td colspan="2" class="font-weight-bold"><small>{{ $intangibleAsset->name }}</small></td>
            </tr>

            <!-- Intangible Asset Information -->
            <tr class="text-center">
                <td colspan="3" class="bg-title text-white font-weight-bold">Información del Acivo Intangible</td>
            </tr>
            <!-- ./Intangible Asset Information -->

            <tr class="text-center">
                <td><small class="font-weight-bold">Unidad de Investigación:
                    </small><small>{{ $intangibleAsset->project->research_unit->name }}</small>
                </td>
                <td><small class="font-weight-bold">Proyecto:
                    </small><small>{{ $intangibleAsset->project->name }}</small></td>
                {{-- <td><small>{{ $activo['progress_bar'] }}%</small></td> --}}
            </tr>

            <!-- Intangible Asset Classification and State -->
            <tr class="text-center bg-subtitle">
                <td colspan="2"><small class="font-weight-bold">Clasificación del Activo Intangible:</small></td>
                <td colspan="1"><small class="font-weight-bold">Estado del Activo Intangible</small></td>
            </tr>
            <tr class="text-center">
                @if ($intangibleAsset->hasClassification())
                    <td colspan="2"><small>{{ $intangibleAsset->classification->name }}</small></td>
                @else
                    <td colspan="2"><small>Este Activo Intangible no tiene una clasificación asignada
                            todavía.</small></td>
                @endif
                @if ($intangibleAsset->hasState())
                    <td colspan="1"><small>{{ $intangibleAsset->intangible_asset_state->name }}</small></td>
                @else
                    <td colspan="1"><small>Este Activo Intangible aún no tiene un estado asignado..</small></td>
                @endif
            </tr>
            <!-- ./Intangible Asset Classification and State -->

            <!-- Intangible Asset Description -->
            <tr class="text-center">
                <td colspan="3" class="bg-title text-white font-weight-bold">Descripción del Activo Intangible</td>
            </tr>
            <tr class="text-center">
                <td colspan="3">
                    <small>
                        @if ($intangibleAsset->hasDescription())
                            <small> {{ $intangibleAsset->description }}</small>
                        @else
                            <small>El Activo Intangible aún no tiene una descripción establecida.</small>
                        @endif
                    </small>
                </td>
            </tr>
            <!-- ./Intangible Asset Description -->

            <!-- Intangible Asset has DPIS -->
            <tr class="text-center">
                <td colspan="3" class="bg-title text-white font-weight-bold">Derechos de Propiedad Intelectual
                    Asociados:</td>
            </tr>
            <tr class="text-center">
                <td colspan="3">
                    @if ($intangibleAsset->hasDpis())
                        <small>
                            @foreach ($intangibleAsset->dpis as $dpi)
                                @if ($loop->first)
                                    {{ $dpi->dpi->name }}
                                @else
                                    / {{ $dpi->dpi->name }}
                                @endif
                            @endforeach
                        </small>
                    @else
                        <small>El Activo Intangible no está asociada a ningún Derecho de Propiedad Intelectual.</small>
                    @endif

                </td>
            </tr>
            <!-- ./Intangible Asset has DPIS -->

            <!-- Intangible Asset Current State -->
            <tr class="text-center">
                <td colspan="3" class="bg-title text-white font-weight-bold">Estado Actual del Activo</td>
            </tr>

            <!-- Intangible Asset has been published -->
            <tr class="text-center">
                <td colspan="2" class="bg-questions">
                    <small class="font-weight-bold">
                        ¿El Activo Intangible ha sido divulgado o
                        publicado?
                    </small>
                </td>
                <td colspan="1">
                    <small>
                        @if ($intangibleAsset->hasBeenPublished())
                            Si
                        @else
                            No
                        @endif
                    </small>
                </td>
            </tr>
            @if ($intangibleAsset->hasBeenPublished())
                <tr class="text-center">
                    <td class="bg-subtitle"><small class="font-weight-bold">Medio de Publicación</small></td>
                    <td class="bg-subtitle"><small class="font-weight-bold">Alcance de la Información</small></td>
                    <td class="bg-subtitle"><small class="font-weight-bold">Fecha de la Publicación</small></td>
                </tr>
                <tr class="text-center">
                    <td><small>{{ $intangibleAsset->intangible_asset_published->published_in }}</small></td>
                    <td><small>{{ $intangibleAsset->intangible_asset_published->information_scope }}</small></td>
                    <td><small>{{ $intangibleAsset->intangible_asset_published->published_at }}</small></td>
                </tr>
            @endif
            <!-- ./Intangible Asset has been published -->

            <!-- Intangible Asset has Confidenciality Contract -->
            <tr class="text-center">
                <td colspan="2" class="bg-questions">
                    <small class="font-weight-bold">
                        ¿El Activo Intangible tiene Contrato de Confidencialidad Firmado?
                    </small>
                </td>
                <td colspan="1">
                    <small>
                        @if ($intangibleAsset->hasConfidencialityContract())
                            Si
                        @else
                            No
                        @endif
                    </small>
                </td>
            </tr>
            @if ($intangibleAsset->hasConfidencialityContract())
                <tr class="text-center">
                    <td colspan="2" class="bg-subtitle">
                        <small class="font-weight-bold">¿Con quién hizo el contrato de confidencialidad?:</small>
                    </td>
                    <td>
                        <small>{{ $intangibleAsset->intangible_asset_confidenciality_contract->organization_confidenciality }}</small>
                    </td>
                </tr>
            @endif
            <!-- ./Intangible Asset has Confidenciality Contract -->

            <!-- Intangible Asset has Creators -->
            <tr class="text-center">
                <td colspan="3" class="bg-subtitle">
                    <small class="font-weight-bold">
                        Creadores Asociados al Activo Intangible
                    </small>
                </td>
            </tr>
            <tr class="text-center">
                <td colspan="3">
                    @if ($intangibleAsset->hasCreators())
                        <small>
                            @foreach ($intangibleAsset->creators as $creator)
                                @if ($loop->first)
                                    <small class="font-weight-bold">{{ $creator->name }}</small>
                                @else
                                    / <small class="font-weight-bold">{{ $creator->name }}</small>
                                @endif
                            @endforeach
                        </small>
                    @else
                        <small>El Activo Intangible no está relacionado con algún Creador.</small>
                    @endif

                </td>
            </tr>
            <!-- ./Intangible Asset has Creators -->

            <!-- Intangible Asset has Session Rights -->
            <tr class="text-center">
                <td colspan="2" class="bg-questions">
                    <small class="font-weight-bold">
                        ¿Existe contrato de sesión de derechos
                        patrimoniales?
                    </small>
                </td>
                <td colspan="1">
                    <small>
                        @if ($intangibleAsset->hasSessionRightContract())
                            Sí
                        @else
                            No
                        @endif
                    </small>
                </td>
            </tr>
            @if ($intangibleAsset->hasSessionRightContract())
                <tr class="text-center">
                    <td colspan="2" class="bg-subtitle">
                        <small class="font-weight-bold">
                            Actual titular de los derechos de
                            propiedad
                            intelectual
                        </small>
                    </td>
                    <td colspan="1">
                        <small> {{ $intangibleAsset->intangible_asset_session_right_contract->owner }}</small>
                    </td>
                </tr>
            @endif
            <!-- ./Intangible Asset has Session Rights -->

            <!-- Intangible Asset has Contability -->
            <tr class="text-center">
                <td colspan="2" class="bg-questions">
                    <small class="font-weight-bold">
                        ¿Se encuentra incorporado a la contabilidad como activo intangible?
                    </small>
                </td>
                <td>
                    <small>
                        @if ($intangibleAsset->hasContability())
                            Sí
                        @else
                            No
                        @endif
                    </small>
                </td>
            </tr>
            @if ($intangibleAsset->hasContability())
                <tr class="text-center">
                    <td colspan="2" class="bg-subtitle">
                        <small class="font-weight-bold">
                            ¿Cuál es el valor del Activo Intangible?:
                        </small>
                    </td>
                    <td colspan="1">
                        <small> {{ $intangibleAsset->intangible_asset_contability->price }}</small>
                    </td>
                </tr>
                <tr class="text-center">
                    <td colspan="3" class="bg-subtitle">
                        <small class="font-weight-bold">
                            Comentarios sobre el Activo Intangible en contabilidad:
                        </small>
                    </td>
                </tr>
                <tr class="text-center">
                    <td colspan="3">
                        <small> {{ $intangibleAsset->intangible_asset_contability->comments }}</small>
                    </td>
                </tr>
            @endif
            <!-- ./Intangible Asset has Contability -->

            <!-- ./Intangible Asset Current State -->


        </tbody>
    </table>

    <div class="page-break"></div>

    <table class="table table-sm table-bordered border-1">
        <tbody>

            <!-- Intangible Asset has Comments -->
            <tr class="text-center">
                <td colspan="3" class="bg-title text-white font-weight-bold">Comentarios del Activo Intangible</td>
            </tr>
            <tr class="text-center">
                <td colspan="1" class="bg-subtitle">
                    <small class="font-weight-bold">Usuario</small>
                </td>
                <td colspan="1" class="bg-subtitle">
                    <small class="font-weight-bold">Comentario</small>
                </td>
                <td colspan="1" class="bg-subtitle">
                    <small class="font-weight-bold">Fecha</small>
                </td>
            </tr>

            @if ($intangibleAsset->hasMessages())
                @foreach ($intangibleAsset->user_messages as $comment)
                    <tr class="text-center">
                        <td colspan="1">
                            <small>{{ $comment->name }}</small>
                        </td>
                        <td colspan="1">
                            <small>{{ $comment->pivot->message }}</small>
                        </td>
                        <td colspan="1">
                            <small>{{ $comment->pivot->updated_at }}</small>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="text-center">
                    <td colspan="3"><small>El Activo Intangible no tiene comentarios registrados.</small></td>
                </tr>
            @endif

            @if ($intangibleAsset->user_messages->count() < 10)
                @php
                    $extra = 20 - $intangibleAsset->user_messages->count();
                    
                    $cont = 0;
                @endphp

                @while ($cont < $extra)
                    <tr class="text-center py-4">
                        <td colspan="1"></td>
                        <td colspan="1"></td>
                        <td colspan="1"></td>
                    </tr>

                    @php
                        $cont++;
                    @endphp
                @endwhile
            @endif
            <!-- ./Intangible Asset has Comments -->

        </tbody>
    </table>

    <div class="page-break"></div>

    <table class="table table-sm table-bordered border-1">
        <tbody>

            <!-- Intangible Asset has Protection Actions -->
            <tr class="text-center">
                <td colspan="3" class="bg-title text-white font-weight-bold">Plan de Acción y Protección</td>
            </tr>

            <!-- Intangible Asset has Deposite -->
            <tr class="text-center">
                <td colspan="2" class="bg-questions">
                    <small class="font-weight-bold">
                        ¿Existe un depósito ante la autoridad competente para el derecho de autor?
                    </small>
                </td>
                <td>
                    <small>
                        @if ($intangibleAsset->hasProtectionAction())
                            Si
                        @else
                            No
                        @endif
                    </small>
                </td>
            </tr>

            @if ($intangibleAsset->hasProtectionAction())
                <tr class="text-center">
                    <td colspan="2" class="bg-subtitle">
                        <small class="font-weight-bold">
                            Indique el número de referencia:
                        </small>
                    </td>
                    <td colspan="1">
                        <small> {{ $intangibleAsset->intangible_asset_protection_action->reference }}</small>
                    </td>
                </tr>
            @endif
            <!-- ./Intangible Asset has Deposite -->

            <!-- Intagible Asset Secret Protection Measures -->
            <tr class="text-center">
                <td colspan="2" class="bg-questions">
                    <small class="font-weight-bold">
                        ¿Se sugiere tomar medidas razonables para la protección de los secretos empresariales?
                    </small>
                </td>
                <td>
                    <small>
                        @if ($intangibleAsset->hasSecretProtectionMeasure())
                            Si
                        @else
                            No
                        @endif
                    </small>
                </td>
            </tr>
            @if ($intangibleAsset->hasSecretProtectionMeasure())
                <tr class="text-center">
                    <td colspan="3" class="bg-subtitle">
                        <small class="font-weight-bold">
                            Medidas Secretas de Protección del Activo Intangible
                        </small>
                    </td>
                </tr>
                <tr class="text-center">
                    <td colspan="3">
                        <small>
                            @forelse ($intangibleAsset->secret_protection_measures as $secretProtectionMeasure)
                                @if ($loop->first)
                                    {{ $secretProtectionMeasure->name }}
                                @else
                                    / {{ $secretProtectionMeasure->name }}
                                @endif
                            @empty
                                No tiene derechos de propiedad intelectual asociados.
                            @endforelse
                        </small>
                    </td>
                </tr>
            @endif
            <!-- ./Intagible Asset Secret Protection Measures -->

            <!-- ./Intangible Asset has Protection Actions Measures -->


            <!-- Intangible Asset has Priority Tools  -->
            <tr class="text-center">
                <td colspan="3" class="bg-title text-white font-weight-bold">Priorización y Decisión del Activo
                    Intangible</td>
            </tr>

            <tr class="text-center">
                <td colspan="2" class="bg-questions">
                    <small class="font-weight-bold">
                        ¿Se debe realizar una búsqueda relacionada con los potenciales DPI asociados al Activo
                        Intangible?
                    </small>
                </td>
                <td>
                    <small>
                        @if ($intangibleAsset->hasPriorityTools())
                            Si
                        @else
                            No
                        @endif
                    </small>
                </td>
            </tr>

            @if ($intangibleAsset->hasPriorityTools())
                @foreach ($intangibleAsset->dpis as $intangibleAssetDpi)
                    <tr class="text-center">
                        <td colspan="3">
                            <small class="font-weight-bold">herramientas de Priorización para el Derecho de Propiedad
                                Intelectual: {{ $intangibleAssetDpi->dpi->upper_name }}</small>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            @foreach ($intangibleAsset->priority_tools as $tool)
                                @if ($tool->dpi_id == $intangibleAssetDpi->dpi_id)
                                    <span
                                        class="btn btn-xs btn-outline-secondary m-0 p-1"><small>{{ $tool->priority_tool->name }}</small></span>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            @endif
            <!-- ./Intangible Asset has Priority Tools -->

            <!-- Intangible Asset is Commercial -->
            <tr class="text-center">
                <td colspan="3" class="bg-title text-white font-weight-bold">
                    Activo Intangible de Uso Comercial
                </td>
            </tr>

            <tr class="text-center">
                <td colspan="2" class="bg-questions">
                    <small class="font-weight-bold">
                        ¿Los Derechos de Propiedad Intelectual asociados a este Activo Intangible tienen algún uso
                        comercial?
                    </small>
                </td>
                <td colspan="1">
                    <small>
                        @if ($intangibleAsset->isCommercial())
                            Si
                        @else
                            No
                        @endif
                    </small>
                </td>
            </tr>
            <tr class="text-center">
                <td colspan="1" class="bg-questions">
                    <small class="font-weight-bold text-small">
                        Describa el uso comercial que tendrá este Activo Intangible:
                    </small>
                </td>
                <td colspan="2">
                    <small>
                        @if ($intangibleAsset->isCommercial())
                            <small>{{ $intangibleAsset->intangible_asset_commercial->reason }}</small>
                        @else
                            <small>El Activo Intangible no tiene uso comercial.</small>
                        @endif
                    </small>
                </td>
            </tr>



            <!-- ./Intangible Asset is Commercial -->

        </tbody>
    </table>
@endsection
