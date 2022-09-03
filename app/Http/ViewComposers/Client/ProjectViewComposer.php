<?php

namespace App\Http\ViewComposers\Client;

use Illuminate\View\View;
use Illuminate\Http\Request;

use App\Repositories\Tenant\AdministrativeUnitRepository;
use App\Repositories\Tenant\ResearchUnitRepository;
use App\Repositories\Tenant\CreatorRepository;

class ProjectViewComposer
{
    /** @var ResearchUnitRepository */
    protected $researchUnitRepository;

    /** @var AdministrativeUnitRepository */
    protected $administrativeUnitRepository;

    /** @var CreatorRepository */
    protected $creatorRepository;

    public function __construct(
        ResearchUnitRepository $researchUnitRepository,
        AdministrativeUnitRepository $administrativeUnitRepository,
        CreatorRepository $creatorRepository
    ) {
        $this->researchUnitRepository = $researchUnitRepository;
        $this->administrativeUnitRepository = $administrativeUnitRepository;
        $this->creatorRepository = $creatorRepository;
    }

    public function compose(View $view)
    {
        $researchUnits = $this->researchUnitRepository->all();
        $administrativeUnits = $this->administrativeUnitRepository->search([], ['research_units'])->get();
        $creators = $this->creatorRepository->allCreators();

        $view->with(compact('researchUnits', 'administrativeUnits',  'creators'));
    }
}
