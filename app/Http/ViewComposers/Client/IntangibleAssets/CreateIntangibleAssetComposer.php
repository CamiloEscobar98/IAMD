<?php

namespace App\Http\ViewComposers\Client\IntangibleAssets;

use Illuminate\View\View;

use App\Repositories\Admin\IntangibleAssetStateRepository;

use App\Services\Client\AdministrativeUnitService;

use App\Repositories\Client\IntangibleAssetRepository;
use App\Repositories\Client\ProjectRepository;
use App\Repositories\Client\ResearchUnitRepository;

class CreateIntangibleAssetComposer
{
    /** @var AdministrativeUnitService */
    protected $administrativeUnitService;

    /** @var ProjectRepository */
    protected $projectRepository;

    /** @var ResearchUnitRepository */
     protected $researchUnitRepository;

    /** @var IntangibleAssetStateRepository */
    protected $intangibleAssetStateRepository;

    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    public function __construct(
        AdministrativeUnitService $administrativeUnitService,

        ProjectRepository $projectRepository,
        ResearchUnitRepository $researchUnitRepository,
        IntangibleAssetStateRepository $intangibleAssetStateRepository,
        IntangibleAssetRepository $intangibleAssetRepository
    ) {
        $this->administrativeUnitService = $administrativeUnitService;

        $this->projectRepository = $projectRepository;
        $this->researchUnitRepository = $researchUnitRepository;
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;
        $this->intangibleAssetRepository = $intangibleAssetRepository;
    }


    public function compose(View $view)
    {
        $projectId =  old('project_id');

        $projects = $this->projectRepository->all();

        if (!$projectId) {
            $researchUnitsItems = collect();
        } else {
            $researchUnitsItems = $this->researchUnitRepository->search(['project_id' => $projectId])->get();
        }

        // dd($projectId);

        $researchUnits = $researchUnitsItems->pluck('name', 'id')->prepend('---Seleccionar Unidades Investigativas');;

        $projects = $projects->pluck('name', 'id')->prepend('---Seleccionar Proyecto');

        /** Intangible Asset States */
        $states = $this->intangibleAssetStateRepository->all();

        $view->with(compact('projects', 'states', 'researchUnits'));
    }
}
