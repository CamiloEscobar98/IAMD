<?php

namespace App\Http\ViewComposers\Client;

use App\Repositories\Tenant\AdministrativeUnitRepository;
use App\Repositories\Tenant\CreatorRepository;
use Illuminate\View\View;
use Illuminate\Http\Request;

use App\Repositories\Tenant\ResearchUnitCategoryRepository;

class ResearchUnitViewComposer
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
        $creators = $this->creatorRepository->allCreators();

        $view->with(compact('researchUnitCategories', 'administrativeUnits',  'creators'));
    }
}
