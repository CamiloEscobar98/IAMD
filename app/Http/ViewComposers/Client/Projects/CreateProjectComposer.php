<?php

namespace App\Http\ViewComposers\Client\Projects;

use Illuminate\View\View;

use App\Repositories\Client\AdministrativeUnitRepository;
use App\Repositories\Client\ResearchUnitRepository;
use App\Repositories\Client\CreatorRepository;
use App\Repositories\Client\FinancingTypeRepository;
use App\Repositories\Client\ProjectContractTypeRepository;
use App\Repositories\Client\ProjectRepository;
use App\Services\Client\AdministrativeUnitService;
use Illuminate\Database\Eloquent\Collection;

class CreateProjectComposer
{
    /** @var AdministrativeUnitService */
    protected $administrativeUnitService;

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
        AdministrativeUnitService $administrativeUnitService,
        AdministrativeUnitRepository $administrativeUnitRepository,
        ResearchUnitRepository $researchUnitRepository,
        ProjectRepository $projectRepository,

        CreatorRepository $creatorRepository,
        FinancingTypeRepository $financingTypeRepository,
        ProjectContractTypeRepository $projectContractTypeRepository
    ) {
        $this->administrativeUnitService = $administrativeUnitService;
        $this->administrativeUnitRepository = $administrativeUnitRepository;
        $this->researchUnitRepository = $researchUnitRepository;
        $this->projectRepository = $projectRepository;

        $this->creatorRepository = $creatorRepository;
        $this->financingTypeRepository = $financingTypeRepository;
        $this->projectContractTypeRepository = $projectContractTypeRepository;
    }

    public function compose(View $view)
    {
        /** @var \Illuminate\Database\Eloquent\Collection $researchUnits */
        $administrativeUnits = $this->administrativeUnitRepository->search([], ['research_units'], [], ['research_units'])->get();

        /** Creators */
        $directors = $this->creatorRepository->all(['id', 'name'])->pluck('name', 'id')->prepend('---Seleccionar un director para el proyecto', -1);

        /** Financing Types */
        $financingTypes = $this->financingTypeRepository->all(['id', 'name'])->pluck('name', 'id')->prepend('---Seleccionar la financiación del proyecto', -1);

        /** Project Contract Types */
        $projectContractTypes = $this->projectContractTypeRepository->all(['id', 'name'])->pluck('name', 'id')->prepend('---Seleccionar un acto administrativo', -1);

        $view->with(compact(
            'administrativeUnits',
            'directors',
            'financingTypes',
            'projectContractTypes'
        ));
    }
}
