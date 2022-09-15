<?php

namespace App\Http\ViewComposers\Client\Projects;

use Illuminate\View\View;

use App\Repositories\Client\AdministrativeUnitRepository;
use App\Repositories\Client\ResearchUnitRepository;
use App\Repositories\Client\CreatorRepository;
use App\Repositories\Client\FinancingTypeRepository;
use App\Repositories\Client\ProjectContractTypeRepository;
use App\Repositories\Client\ProjectRepository;

class CreateProjectComposer
{
    /** @var AdministrativeUnitRepository */
    protected $administrativeUnitRepository;

    /** @var ResearchUnitRepository */
    protected $researchUnitRepository;

    /** @var ProjectRepository */
    protected $projectRepository;

    /** @var CreatorRepository */
    protected $creatorRepository;

    /** @var FinancingTypeRepository */
    protected $financingTypeRepository;

    /** @var ProjectContractTypeRepository */
    protected $projectContractTypeRepository;

    public function __construct(
        AdministrativeUnitRepository $administrativeUnitRepository,
        ResearchUnitRepository $researchUnitRepository,
        ProjectRepository $projectRepository,

        CreatorRepository $creatorRepository,
        FinancingTypeRepository $financingTypeRepository,
        ProjectContractTypeRepository $projectContractTypeRepository
    ) {
        $this->administrativeUnitRepository = $administrativeUnitRepository;
        $this->researchUnitRepository = $researchUnitRepository;
        $this->projectRepository = $projectRepository;

        $this->creatorRepository = $creatorRepository;
        $this->financingTypeRepository = $financingTypeRepository;
        $this->projectContractTypeRepository = $projectContractTypeRepository;
    }

    public function compose(View $view)
    {
        $projectId = request()->project;

        /** Administratvie Units */
        $administrativeUnits = $this->administrativeUnitRepository->all();

        if ($projectId) {

            /** @var \App\Models\Client\Project\Project $project */
            $project = $this->projectRepository->getById($projectId);

            /** @var \App\Models\Client\ResearchUnit $researchUnit */
            $researchUnit = $this->researchUnitRepository->getById($project->research_unit_id);

            /** @var \App\Models\Client\AdministrativeUnit $administrativeUnit */
            $administrativeUnit = $this->administrativeUnitRepository->getById($researchUnit->administrative_unit_id);

            /** Research Units */
            $researchUnits = $this->researchUnitRepository->getByAdministrativeUnit($administrativeUnit);
        } else {

            /** @var \App\Models\Client\AdministrativeUnit $administrativeUnit */
            $administrativeUnit = $administrativeUnits->first();

            $researchUnits = $this->researchUnitRepository->getByAdministrativeUnit($administrativeUnit);

            /** @var \App\Models\Client\ResearchUnit $researchUnit */
            $researchUnit = $researchUnits->first();
        }

        /** Creators */
        $creators = $this->creatorRepository->allCreators();

        /** Financing Types */
        $financingTypes = $this->financingTypeRepository->all();

        /** Project Contract Types */
        $projectContractTypes = $this->projectContractTypeRepository->all();

        $view->with(compact(
            'researchUnits',
            'administrativeUnits',
            'administrativeUnit',
            'researchUnit',
            'creators',
            'financingTypes',
            'projectContractTypes'
        ));
    }
}
