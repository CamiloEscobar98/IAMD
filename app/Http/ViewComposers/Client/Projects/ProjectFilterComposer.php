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
        $params = request()->all();

        /** Administrative Units */
        $administrativeUnits = $this->administrativeUnitRepository->all();


        if (isset($params['administrative_unit_id']) && $params['administrative_unit_id']) {

            /** @var \App\Models\Client\AdministrativeUnit */
            $administrativeUnit = $this->administrativeUnitRepository->getById($params['administrative_unit_id']);

            /** Research Units */
            $researchUnits = $this->researchUnitRepository->getByAdministrativeUnit($administrativeUnit);
        } else {

            /** Research Units */
            $researchUnits = $this->researchUnitRepository->getByAdministrativeUnit($administrativeUnits->first());
        }

        $administrativeUnits = $administrativeUnits->pluck('name', 'id')->prepend('Seleccionar Subdirección Técnica', 0);

        $researchUnits = $researchUnits->pluck('name', 'id')->prepend('Seleccionar Unidad Investigativa', 0);

        // dd($researchUnits);

        /** Creators */
        $creators = $this->creatorRepository->getAllCreators();

        $view->with(compact('administrativeUnits', 'researchUnits', 'creators'));
    }
}
