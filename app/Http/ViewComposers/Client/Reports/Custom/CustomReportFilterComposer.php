<?php

namespace App\Http\ViewComposers\Client\Reports\Custom;

use Illuminate\View\View;

use App\Repositories\Admin\IntangibleAssetStateRepository;
use App\Repositories\Admin\IntellectualPropertyRightCategoryRepository;
use App\Repositories\Client\AdministrativeUnitRepository;
use App\Repositories\Client\CreatorRepository;
use App\Repositories\Client\ProjectRepository;
use App\Repositories\Client\ResearchUnitRepository;
use App\Services\Admin\IntellectualPropertyRightCategoryService;
use App\Services\Client\AdministrativeUnitService;

class CustomReportFilterComposer
{
    /** @var IntellectualPropertyRightCategoryRepository */
    protected $intellectualPropertyRightCategoryRepository;

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

    /** @var CreatorRepository */
    protected $creatorRepository;

    public function __construct(
        AdministrativeUnitService $administrativeUnitService,

        IntellectualPropertyRightCategoryRepository $intellectualPropertyRightCategoryRepository,
        AdministrativeUnitRepository $administrativeUnitRepository,
        IntangibleAssetStateRepository $intangibleAssetStateRepository,
        ResearchUnitRepository $researchUnitRepository,
        ProjectRepository $projectRepository,
        CreatorRepository $creatorRepository
    ) {
        $this->administrativeUnitService = $administrativeUnitService;

        $this->intellectualPropertyRightCategoryRepository = $intellectualPropertyRightCategoryRepository;
        $this->administrativeUnitRepository = $administrativeUnitRepository;
        $this->researchUnitRepository = $researchUnitRepository;
        $this->projectRepository = $projectRepository;
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;
        $this->creatorRepository = $creatorRepository;
    }

    public function compose(View $view)
    {
        $administrativeUnits = $this->administrativeUnitRepository->all()->pluck('name', 'id')->prepend('---Seleccionar Facultad');

        $projects = $this->projectRepository->all()->pluck('name', 'id')->prepend('---Seleccionar Proyecto');

        $researchUnits = $this->researchUnitRepository->all()->pluck('name', 'id');

        $creators = $this->creatorRepository->all()->pluck('name', 'id');

        $categories = $this->intellectualPropertyRightCategoryRepository->all()->pluck('name', 'id')->prepend('---Seleccionar Categoría', -1);

        /** Intangible Asset States */
        $states = $this->intangibleAssetStateRepository->all()->pluck('name', 'id');

        $phases = collect([
            1 => 'Fase 1: Clasificación del Activo Intangible',
            2 => 'Fase 2: Descripción',
            3 => 'Fase 3: Estado del Activo Intangible',
            4 => 'Fase 4: Derechos de Propiedad Intelectual vinculados',
            5 => 'Fase 5: Estado Actual del Activo Intangible',
            6 => 'Fase 6: Comentarios y/o Sugerencias',
            7 => 'Fase 7: Plan de Acción y Protección del Activo Intangible',
            8 => 'Fase 8: Priorización y Decisión del Activo Intangible',
            9 => 'Fase 9: Activo Intangible de Uso Comercial',
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
        ]);

        $view->with(compact(
            'phases',
            'ordersBy',
            'intangibleAssetCustomGeneral',
            'graphics',

            'categories',

            'states',
            'creators',

            'administrativeUnits',
            'projects',
            'researchUnits',
        ));
    }
}
