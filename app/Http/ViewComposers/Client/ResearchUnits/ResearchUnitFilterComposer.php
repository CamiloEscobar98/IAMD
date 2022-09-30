<?php

namespace App\Http\ViewComposers\Client\ResearchUnits;

use Illuminate\View\View;

use App\Repositories\Client\AdministrativeUnitRepository;
use App\Repositories\Client\ResearchUnitCategoryRepository;
use App\Repositories\Client\CreatorRepository;

class ResearchUnitFilterComposer
{
    /** @var ResearchUnitCategoryRepository */
    protected $researchUnitCategoryRepository;

    /** @var AdministrativeUnitRepository */
    protected $administrativeUnitRepository;

    /** @var CreatorRepository */
    protected $creatorRepository;

    public function __construct(
        ResearchUnitCategoryRepository $researchUnitCategoryRepository,
        AdministrativeUnitRepository $administrativeUnitRepository,
        CreatorRepository $creatorRepository
    ) {
        $this->researchUnitCategoryRepository = $researchUnitCategoryRepository;
        $this->administrativeUnitRepository = $administrativeUnitRepository;
        $this->creatorRepository = $creatorRepository;
    }

    public function compose(View $view)
    {
        $researchUnitCategories = $this->researchUnitCategoryRepository->all();

        $administrativeUnits = $this->administrativeUnitRepository->all();

        $directors = $this->creatorRepository->getDirectors();

        $inventoryManagers = $this->creatorRepository->getInventoryManagers();

        $view->with(compact('researchUnitCategories', 'administrativeUnits',  'directors', 'inventoryManagers'));
    }
}
