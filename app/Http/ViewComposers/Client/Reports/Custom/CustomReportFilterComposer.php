<?php

namespace App\Http\ViewComposers\Client\Reports\Custom;

use Illuminate\View\View;

use App\Repositories\Admin\IntangibleAssetStateRepository;
use App\Repositories\Client\AdministrativeUnitRepository;
use App\Repositories\Client\ProjectRepository;
use App\Repositories\Client\ResearchUnitRepository;
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

    /** @var AdministrativeUnitRepository */
    protected $administrativeUnitRepository;

    /** @var ResearchUnitRepository */
    protected $researchUnitRepository;

    /** @var ProjectRepository */
    protected $projectRepository;

    public function __construct(
        IntellectualPropertyRightCategoryService $intellectualPropertyRightCategoryService,
        AdministrativeUnitService $administrativeUnitService,

        AdministrativeUnitRepository $administrativeUnitRepository,
        ResearchUnitRepository $researchUnitRepository,
        ProjectRepository $projectRepository,
        IntangibleAssetStateRepository $intangibleAssetStateRepository,
    ) {
        $this->intellectualPropertyRightCategoryService = $intellectualPropertyRightCategoryService;
        $this->administrativeUnitService = $administrativeUnitService;

        $this->administrativeUnitRepository = $administrativeUnitRepository;
        $this->researchUnitRepository = $researchUnitRepository;
        $this->projectRepository = $projectRepository;
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;
    }

    public function compose(View $view)
    {
        $params = request()->all();

        $administrativeUnitId = old('administrative_unit_id');

        $projectId =  old('project_id');

        $projectItems = $this->projectRepository->all();

        $projects = $projectItems->pluck('name', 'id')->prepend('---Seleccionar Proyecto');

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
                'name' =>  'with_graphics_assets_classification_per_research_unit',
                'value' =>  'Mostrar/Ocultar Gráfica Tipos de Activos Intangibles asociados a un Grupo de Investigación.'
            ],
            // [
            //     'name' => 'with_graphics_assets_state_classification_per_research_unit',
            //     'value' => 'Mostrar/Ocultar Gráfica Estados de los Tipos de Activos Intangibles asociados a un Grupo de Investigación.'
            // ]
        ]);

        $view->with(compact(
            'projects',
            'phases',
            'ordersBy',
            'intangibleAssetCustomGeneral',
            'graphics',
        ));
    }
}
