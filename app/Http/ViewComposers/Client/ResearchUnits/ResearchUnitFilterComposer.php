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
        $researchUnitCategories = $this->researchUnitCategoryRepository->all(['id', 'name'])->pluck('name', 'id');
        $administrativeUnits = $this->administrativeUnitRepository->all(['id', 'name'])->pluck('name', 'id');

        $creators = $this->creatorRepository->all(['id', 'name']);

        $directors = $creators->pluck('name', 'id');

        $inventoryManagers = $creators->pluck('name', 'id');

        $view->with(compact('researchUnitCategories', 'administrativeUnits',  'directors', 'inventoryManagers'));
    }
}
