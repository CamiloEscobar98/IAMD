<?php

namespace App\Http\ViewComposers\Client\IntangibleAssets;

use Illuminate\View\View;

use App\Repositories\Admin\IntangibleAssetStateRepository;

use App\Repositories\Client\AdministrativeUnitRepository;
use App\Repositories\Client\ResearchUnitRepository;
use App\Repositories\Client\ProjectRepository;

use App\Repositories\Client\IntangibleAssetRepository;
use App\Services\Client\AdministrativeUnitService;

class CreateIntangibleAssetComposer
{
    /** @var AdministrativeUnitService */
    protected $administrativeUnitService;

    /** @var AdministrativeUnitRepository */
    protected $administrativeUnitRepository;

    /** @var ResearchUnitRepository */
    protected $researchUnitRepository;

    /** @var ProjectRepository */
    protected $projectRepository;

    /** @var IntangibleAssetStateRepository */
    protected $intangibleAssetStateRepository;

    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    public function __construct(
        IntangibleAssetStateRepository $intangibleAssetStateRepository,

        AdministrativeUnitService $administrativeUnitService,
        AdministrativeUnitRepository $administrativeUnitRepository,
        ResearchUnitRepository $researchUnitRepository,
        ProjectRepository $projectRepository,

        IntangibleAssetRepository $intangibleAssetRepository
    ) {
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;

        $this->administrativeUnitService = $administrativeUnitService;
        $this->administrativeUnitRepository = $administrativeUnitRepository;
        $this->researchUnitRepository = $researchUnitRepository;
        $this->projectRepository = $projectRepository;

        $this->intangibleAssetRepository = $intangibleAssetRepository;
    }


    public function compose(View $view)
    {
        $intangibleAssetId = request()->intangible_asset;

        [$administrativeUnits, $researchUnits, $projects, $administrativeUnit, $researchUnit, $project] = $this->administrativeUnitService->getAdministrativeUnitsSelectByIntangibleAssetForm($intangibleAssetId);

        // dd([$administrativeUnits, $researchUnits, $projects, $administrativeUnit, $researchUnit, $project]);
        /** Intangible Asset States */
        $states = $this->intangibleAssetStateRepository->all();

        $view->with(compact('administrativeUnits', 'researchUnits', 'projects', 'administrativeUnit', 'researchUnit', 'project', 'states'));
    }
}
