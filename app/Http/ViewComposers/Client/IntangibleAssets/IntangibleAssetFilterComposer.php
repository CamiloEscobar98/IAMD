<?php

namespace App\Http\ViewComposers\Client\IntangibleAssets;

use Illuminate\View\View;

use App\Repositories\Client\AdministrativeUnitRepository;
use App\Repositories\Client\ResearchUnitRepository;
use App\Repositories\Client\ProjectRepository;
use App\Repositories\Admin\IntangibleAssetStateRepository;

class IntangibleAssetFilterComposer
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

        /** Intangible Asset States */
        $states = $this->intangibleAssetStateRepository->all();

        $view->with(compact('administrativeUnits', 'researchUnits', 'projects', 'states'));
    }
}
