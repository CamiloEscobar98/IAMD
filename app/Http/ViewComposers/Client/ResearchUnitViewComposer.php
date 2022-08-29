<?php

namespace App\Http\ViewComposers\Client;

use App\Repositories\Tenant\AdministrativeUnitRepository;
use Illuminate\View\View;
use Illuminate\Http\Request;

use App\Repositories\Tenant\ResearchUnitCategoryRepository;

class ResearchUnitViewComposer
{
    /** @var ResearchUnitCategoryRepository */
    protected $researchUnitCategoryRepository;

    /** @var AdministrativeUnitRepository */
    protected $administrativeUnitRepository;

    public function __construct(
        ResearchUnitCategoryRepository $researchUnitCategoryRepository,
        AdministrativeUnitRepository $administrativeUnitRepository
    ) {
        $this->researchUnitCategoryRepository = $researchUnitCategoryRepository;
        $this->administrativeUnitRepository = $administrativeUnitRepository;
    }

    public function compose(View $view)
    {
        $researchUnitCategories = $this->researchUnitCategoryRepository->all();
        $administrativeUnits = $this->administrativeUnitRepository->all();

        $view->with(compact('researchUnitCategories', 'administrativeUnits'));
    }
}
