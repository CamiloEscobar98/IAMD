<?php

namespace App\Http\ViewComposers\Client\ResearchUnits;

use Illuminate\View\View;

use App\Repositories\Client\AdministrativeUnitRepository;
use App\Repositories\Client\ResearchUnitCategoryRepository;
use App\Repositories\Client\CreatorRepository;

class CreateResearchUnitComposer
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
        $researchUnitCategories = $this->researchUnitCategoryRepository->all()->pluck('name', 'id')->prepend('---Selecciona una Categoría para la Unidad Investigativa');
        $administrativeUnits = $this->administrativeUnitRepository->all()->pluck('name', 'id')->prepend('---Selecciona una facultad', -1);
        // dd($administrativeUnits->toArray());
        $creators = $this->creatorRepository->getAllCreators();

        $directorsArray = $creators->pluck('name', 'id');
        $inventoryManagersArray = $creators->pluck('name', 'id');

        $directors = $directorsArray->prepend('---Selecciona un Director', -1);
        $inventoryManagers = $inventoryManagersArray->prepend('---Selecciona un Director de Inventario', -1);

        $view->with(compact('researchUnitCategories', 'administrativeUnits',  'directors', 'inventoryManagers'));
    }
}
