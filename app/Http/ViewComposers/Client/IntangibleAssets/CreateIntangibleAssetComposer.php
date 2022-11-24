<?php

namespace App\Http\ViewComposers\Client\IntangibleAssets;

use Illuminate\View\View;

use App\Repositories\Admin\IntangibleAssetStateRepository;

use App\Services\Client\AdministrativeUnitService;

use App\Repositories\Client\IntangibleAssetRepository;

class CreateIntangibleAssetComposer
{
    /** @var AdministrativeUnitService */
    protected $administrativeUnitService;

    /** @var IntangibleAssetStateRepository */
    protected $intangibleAssetStateRepository;

    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    public function __construct(
        AdministrativeUnitService $administrativeUnitService,
        
        IntangibleAssetStateRepository $intangibleAssetStateRepository,
        IntangibleAssetRepository $intangibleAssetRepository
    ) {
        $this->administrativeUnitService = $administrativeUnitService;
        
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;
        $this->intangibleAssetRepository = $intangibleAssetRepository;
    }


    public function compose(View $view)
    {
        $intangibleAssetId = request()->intangible_asset;

        [$administrativeUnits, $researchUnits, $projects, $administrativeUnit, $researchUnit, $project] = $this->administrativeUnitService->getAdministrativeUnitsSelectByIntangibleAssetForm($intangibleAssetId);

        /** Intangible Asset States */
        $states = $this->intangibleAssetStateRepository->all();

        $view->with(compact('administrativeUnits', 'researchUnits', 'projects', 'administrativeUnit', 'researchUnit', 'project', 'states'));
    }
}
