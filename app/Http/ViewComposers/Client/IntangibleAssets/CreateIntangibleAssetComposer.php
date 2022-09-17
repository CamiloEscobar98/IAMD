<?php

namespace App\Http\ViewComposers\Client\IntangibleAssets;

use Illuminate\View\View;

use App\Repositories\Admin\IntangibleAssetStateRepository;

use App\Repositories\Client\AdministrativeUnitRepository;
use App\Repositories\Client\ResearchUnitRepository;
use App\Repositories\Client\ProjectRepository;

use App\Repositories\Client\IntangibleAssetRepository;

class CreateIntangibleAssetComposer
{
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

        AdministrativeUnitRepository $administrativeUnitRepository,
        ResearchUnitRepository $researchUnitRepository,
        ProjectRepository $projectRepository,

        IntangibleAssetRepository $intangibleAssetRepository
    ) {
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;

        $this->administrativeUnitRepository = $administrativeUnitRepository;
        $this->researchUnitRepository = $researchUnitRepository;
        $this->projectRepository = $projectRepository;

        $this->intangibleAssetRepository = $intangibleAssetRepository;
    }


    public function compose(View $view)
    {
        $intangibleAssetId = request()->intangible_asset;

        /** Administratvie Units */
        $administrativeUnits =  $this->administrativeUnitRepository->all();

        /** Research Units */
        $researchUnits = $this->researchUnitRepository->getByAdministrativeUnit($administrativeUnits->first());

        /** Projects */
        $projects = $this->projectRepository->getByResearchUnit($researchUnits->first());

        if ($intangibleAssetId) {

            /** @var \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset */
            $intangibleAsset = $this->intangibleAssetRepository->getById($intangibleAssetId);

            if ($intangibleAsset->hasProject()) {

                /** @var \App\Models\Client\Project\Project */
                $project = $this->projectRepository->getById($intangibleAsset->project_id);

                /** @var \App\Models\Client\ResearchUnit $researchUnit */
                $researchUnit = $this->researchUnitRepository->getById($project->research_unit_id);

                /** @var \App\Models\Client\AdministrativeUnit $administrativeUnit */
                $administrativeUnit = $this->administrativeUnitRepository->getById($researchUnit->administrative_unit->id);

                /** Research Units */
                $researchUnits = $this->researchUnitRepository->getByAdministrativeUnit($administrativeUnit);

                /** Projects */
                $projects = $this->projectRepository->getByResearchUnit($researchUnit);
            }
        } else {

            /** @var \App\Models\Client\AdministrativeUnit $administrativeUnit */
            $administrativeUnit = $administrativeUnits->first();

            /** Research Units */
            $researchUnits = $this->researchUnitRepository->getByAdministrativeUnit($administrativeUnit);

            /** @var \App\Models\Client\ResearchUnit $researchUnit */
            $researchUnit = $researchUnits->first();

            /** Projects */
            $projects = $this->projectRepository->getByResearchUnit($researchUnit);

            /** @var \App\Models\Client\Project\Project */
            $project = $projects->first();
        }

        /** Intangible Asset States */
        $states = $this->intangibleAssetStateRepository->all();

        $view->with(compact('administrativeUnits', 'researchUnits', 'projects', 'administrativeUnit', 'researchUnit', 'project', 'states'));
    }
}
