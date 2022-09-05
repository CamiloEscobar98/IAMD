<?php

namespace App\Http\ViewComposers\Client\Projects;

use Illuminate\View\View;
use Illuminate\Http\Request;

use App\Repositories\Client\AdministrativeUnitRepository;
use App\Repositories\Client\ResearchUnitRepository;
use App\Repositories\Client\CreatorRepository;

class ProjectFilterComposer
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
