<?php

namespace App\Http\ViewComposers\Client\Reports\Custom;

use Illuminate\View\View;

use App\Repositories\Admin\IntangibleAssetStateRepository;
use App\Services\Admin\IntellectualPropertyRightCategoryService;
use App\Services\Client\AdministrativeUnitService;

class CustomReportFilterComposer
{
    /** @var IntellectualPropertyRightCategoryService */
    protected $intellectualPropertyRightCategoryService;

    /** @var AdministrativeUnitService */
    protected $administrativeUnitService;

    /** @var IntangibleAssetStateRepository */
    protected $intangibleAssetStateRepository;

    public function __construct(
        IntellectualPropertyRightCategoryService $intellectualPropertyRightCategoryService,

        AdministrativeUnitService $administrativeUnitService,
        IntangibleAssetStateRepository $intangibleAssetStateRepository,
    ) {
        $this->intellectualPropertyRightCategoryService = $intellectualPropertyRightCategoryService;

        $this->administrativeUnitService = $administrativeUnitService;
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;
    }

    public function compose(View $view)
    {
        $params = request()->all();

        [$administrativeUnits, $researchUnits, $projects, $administrativeUnit, $researchUnit, $project] = $this->administrativeUnitService->getAdministrativeUnitsSelectByParams($params);

        [$categories, $subCategories, $products, $category, $subCategory, $product] = $this->intellectualPropertyRightCategoryService->getIntellectualPropertyCategorySelect();

        /** Intangible Asset States */
        $states = $this->intangibleAssetStateRepository->all();

        $phases = collect([
            1 => 'Fase 1: Clasificación',
            2 => 'Fase 2: Descripción',
            3 => 'Fase 3: Estado',
            4 => 'Fase 4: Derechos de Propiedad Intelectual',
            5 => 'Fase 5: Estado Actual',
            6 => 'Fase 6: Comentarios',
            7 => 'Fase 7: Plan de Acción y Protección',
            8 => 'Fase 8: Priorización y Decisión',
            9 => 'Fase 9: Uso Comercial',
        ]);

        $ordersBy = collect([
            -1 => 'Seleccionar un orden',
            1 => 'Antiguos',
            2 => 'Recientes',
        ]);

        $intangibleAssetCustomGeneral = collect([
            [
                'name' =>  'with_general_total',
                'value' =>  'Mostrar/Ocultar Total de Activos Intangibles.'
            ],
            [
                'name' => 'with_general_phase_status',
                'value' => 'Mostrar/Ocultar Proceso de las Fases de los Activos Intangibles.'
            ],
        ]);

        $intangibleAssetCustomContents = collect([
            [
                'name' =>  'with_basic_information',
                'value' =>  'Mostrar/Ocultar Informaciíon Básica.'
            ],
            [
                'name' => 'with_dpis',
                'value' => 'Mostrar/Ocultar Derechos de Propiedad Intelectual Asociados.'
            ],
            [
                'name' =>  'with_published',
                'value' =>  'Mostrar/Ocultar si ha sido Publicado o Divulgado.'
            ],
            [
                'name' =>  'with_confidenciality_contract',
                'value' =>  'Mostrar/Ocultar si tiene Contrato de Confidencialidad.'
            ],
            [
                'name' =>  'with_creators',
                'value' =>  'Mostrar/Ocultar si tiene Creadores asociados.'
            ],
            [
                'name' =>  'with_right_session',
                'value' =>  'Mostrar/Ocultar si tiene Contrato de Sesión de Derechos Patrimoniales.'
            ],
            [
                'name' =>  'with_contability',
                'value' =>  'Mostrar/Ocultar si está incorporado a la Contabilidad.'
            ],
            [
                'name' =>  'with_comments',
                'value' =>  'Mostrar/Ocultar historial de comentarios.'
            ],
            [
                'name' =>  'with_protection_action',
                'value' =>  'Mostrar/Ocultar si tiene un Plan de Acción y Protección.'
            ],
            [
                'name' =>  'with_priority_tools',
                'value' =>  'Mostrar/Ocultar si cuenta con Herramientas de Priorización para el Derecho de Propiedad Intelectual.'
            ],
            [
                'name' =>  'with_commercial',
                'value' =>  'Mostrar/Ocultar si los Derechos de Propiedad Intelectual tiene un Uso Comercial.'
            ],
        ]);

        $graphics = collect([
            [
                'name' =>  'with_graphics_assets_per_year',
                'value' =>  'Mostrar/Ocultar Gráfica Activos Intangibles por Año.'
            ],
            [
                'name' =>  'with_graphics_assets_classification_per_year',
                'value' =>  'Mostrar/Ocultar Gráfica Clasificación de los Activos Intangibles por Año.'
            ],
            [
                'name' =>  'with_graphics_assets_state_per_year',
                'value' =>  'Mostrar/Ocultar Gráfica Estados de Protección de los Tipos de Activos Intangibles por Año.'
            ],
            [
                'name' =>  'with_graphics_assets_classification_per_administrative_unit',
                'value' =>  'Mostrar/Ocultar Gráfica Tipos de Activos Intangibles asociados a una Facultad.'
            ],
            [
                'name' =>  'with_graphics_assets_state_research_unit_per_administrative_unit',
                'value' =>  'Mostrar/Ocultar Gráfica Tipos de Activos Intangibles por Estados, asociados a una Facultad.'
            ],
            [
                'name' =>  'with_graphics_assets_research_unit_per_administrative_unit',
                'value' =>  'Mostrar/Ocultar Gráfica Activos Intangibles por Grupos de Investigación asociados a una Facultad.'
            ],
            [
                'name' =>  'with_graphics_assets_classification_per_research_unit',
                'value' =>  'Mostrar/Ocultar Gráfica Tipos de Activos Intangibles asociados a un Grupo de Investigación.'
            ],
            [
                'name' => 'with_graphics_default',
                'value' => 'Mostrar/Ocultar Gráfica Estados de los Tipos de Activos Intangibles asociados a un Grupo de Investigación.'
            ]
        ]);

        $view->with(compact(
            'administrativeUnits',
            'researchUnits',
            'projects',
            'phases',
            'ordersBy',
            'intangibleAssetCustomGeneral',
            'intangibleAssetCustomContents',
            'graphics',
            'categories',
            'subCategories',
            'products',
            'category',
            'subCategory',
            'product'
        ));
    }
}
