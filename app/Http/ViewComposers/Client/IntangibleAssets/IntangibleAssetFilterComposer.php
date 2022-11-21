<?php

namespace App\Http\ViewComposers\Client\IntangibleAssets;

use Illuminate\View\View;

use App\Repositories\Client\AdministrativeUnitRepository;
use App\Repositories\Client\ResearchUnitRepository;
use App\Repositories\Client\ProjectRepository;
use App\Repositories\Admin\IntangibleAssetStateRepository;
use App\Services\Client\AdministrativeUnitService;

class IntangibleAssetFilterComposer
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

    public function __construct(
        AdministrativeUnitService $administrativeUnitService,
        AdministrativeUnitRepository $administrativeUnitRepository,
        ResearchUnitRepository $researchUnitRepository,
        ProjectRepository $projectRepository,
        IntangibleAssetStateRepository $intangibleAssetStateRepository,
    ) {
        $this->administrativeUnitService = $administrativeUnitService;
        $this->administrativeUnitRepository = $administrativeUnitRepository;
        $this->researchUnitRepository = $researchUnitRepository;
        $this->projectRepository = $projectRepository;
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;
    }

    public function compose(View $view)
    {
        $params = request()->all();

        [$administrativeUnits, $researchUnits, $projects, $administrativeUnit, $researchUnit, $project] = $this->administrativeUnitService->getAdministrativeUnitsSelectByParams($params);

        /** Intangible Asset States */
        $states = $this->intangibleAssetStateRepository->all();

        $view->with(compact('administrativeUnits', 'administrativeUnit', 'researchUnits', 'researchUnit', 'projects', 'project', 'states'));
    }
}
