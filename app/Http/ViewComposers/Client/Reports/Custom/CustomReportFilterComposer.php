<?php

namespace App\Http\ViewComposers\Client\Reports\Custom;

use Illuminate\View\View;

use App\Repositories\Client\AdministrativeUnitRepository;
use App\Repositories\Client\ResearchUnitRepository;
use App\Repositories\Client\ProjectRepository;
use App\Repositories\Admin\IntangibleAssetStateRepository;

class CustomReportFilterComposer
{
    /** @var AdministrativeUnitRepository */
    protected $administrativeUnitRepository;

    /** @var ResearchUnitRepository */
    protected $researchUnitRepository;

    /** @var ProjectRepository */
    protected $projectRepository;

    /** @var IntangibleAssetStateRepository */
    protected $intangibleAssetStateRepository;

    public function __construct(
        AdministrativeUnitRepository $administrativeUnitRepository,
        ResearchUnitRepository $researchUnitRepository,
        ProjectRepository $projectRepository,
        IntangibleAssetStateRepository $intangibleAssetStateRepository,
    ) {
        $this->administrativeUnitRepository = $administrativeUnitRepository;
        $this->researchUnitRepository = $researchUnitRepository;
        $this->projectRepository = $projectRepository;
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;
    }

    public function compose(View $view)
    {
        $params = request()->all();

        /** Administratvie Units */
        $administrativeUnits =  $this->administrativeUnitRepository->all();

        if (isset($params['project_id']) && $params['project_id']) {

            /** @var \App\Models\Client\Project\Project $project */
            $project = $this->projectRepository->getById($params['project_id']);

            /** @var \App\Models\Client\ResearchUnit $researchUnit */
            $researchUnit = $this->researchUnitRepository->getById($project->research_unit_id);

            /** @var \App\Models\Client\AdministrativeUnit $administrativeUnit */
            $administrativeUnit = $this->administrativeUnitRepository->getById($researchUnit->administrative_unit_id);

            $researchUnits = $this->researchUnitRepository->getByAdministrativeUnit($administrativeUnit);

            $projects = $this->projectRepository->getByResearchUnit($researchUnit);
        } else {

            /** Research Units */
            $researchUnits = $this->researchUnitRepository->getByAdministrativeUnit($administrativeUnits->first());

            /** Projects */
            $projects = $this->projectRepository->getByResearchUnit($researchUnits->first());
        }

        $administrativeUnits = $administrativeUnits->pluck('name', 'id')->prepend('Seleccionar Subdirección Técnica', -1);

        $researchUnits = $researchUnits->pluck('name', 'id')->prepend('Seleccionar Unidad Investigativa', -1);

        $projects = $projects->pluck('name', 'id')->prepend('Seleccionar Proyecto', -1);

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
            10 => 'Todas las Fases Completadas',
        ]);

        $ordersBy = collect([
            -1 => 'Seleccionar un orden',
            1 => 'Antiguos',
            2 => 'Recientes',
        ]);

        $view->with(compact('administrativeUnits', 'researchUnits', 'projects', 'phases', 'ordersBy'));
    }
}
