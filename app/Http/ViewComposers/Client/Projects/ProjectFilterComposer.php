<?php

namespace App\Http\ViewComposers\Client\Projects;

use Illuminate\View\View;
use Illuminate\Http\Request;

use App\Repositories\Client\AdministrativeUnitRepository;
use App\Repositories\Client\ResearchUnitRepository;
use App\Repositories\Client\CreatorRepository;
use App\Repositories\Client\ProjectRepository;

class ProjectFilterComposer
{
    /** @var AdministrativeUnitRepository */
    protected $administrativeUnitRepository;

    /** @var ResearchUnitRepository */
    protected $researchUnitRepository;

    /** @var ProjectRepository */
    protected $projectRepository;

    /** @var CreatorRepository */
    protected $creatorRepository;

    public function __construct(
        AdministrativeUnitRepository $administrativeUnitRepository,
        ResearchUnitRepository $researchUnitRepository,
        ProjectRepository $projectRepository,

        CreatorRepository $creatorRepository
    ) {
        $this->administrativeUnitRepository = $administrativeUnitRepository;
        $this->researchUnitRepository = $researchUnitRepository;
        $this->projectRepository = $projectRepository;

        $this->creatorRepository = $creatorRepository;
    }

    public function compose(View $view)
    {
        $administrativeUnitId = request('administrative_unit_id');

        /** Administrative Units */
        $administrativeUnits = $this->administrativeUnitRepository->all();

        $researchUnits = collect();

        if ($administrativeUnitId) {
            /** @var \App\Models\Client\AdministrativeUnit */
            $administrativeUnit = $this->administrativeUnitRepository->getById($administrativeUnitId);
            /** Research Units */
            $researchUnits = $this->researchUnitRepository->getByAdministrativeUnit($administrativeUnits->first());
        }

        $administrativeUnits = $administrativeUnits->pluck('name', 'id')->prepend('---Seleccionar Facultad');

        $researchUnits = $researchUnits->pluck('name', 'id')->prepend('---Seleccionar Unidad Investigativa');


        /** Creators */
        $directors = $this->creatorRepository->all(['id', 'name'])->pluck('name', 'id');

        $view->with(compact('administrativeUnits', 'researchUnits', 'directors'));
    }
}
