<?php

namespace App\Http\ViewComposers\Client;

use Illuminate\View\View;

use App\Repositories\Client\UserRepository;
use App\Repositories\Client\CreatorExternalRepository;
use App\Repositories\Client\CreatorInternalRepository;

use App\Repositories\Client\AdministrativeUnitRepository;
use App\Repositories\Client\ResearchUnitRepository;
use App\Repositories\Client\ProjectRepository;
use App\Repositories\Client\IntangibleAssetRepository;

use App\Repositories\Client\StrategyCategoryRepository;
use App\Repositories\Client\StrategyRepository;
use App\Repositories\Client\FinancingTypeRepository;
use App\Repositories\Client\PriorityToolRepository;
use App\Repositories\Client\SecretProtectionMeasureRepository;

class DashboardComposer
{
    /** @var UserRepository */
    protected $userRepository;

    /** @var CreatorInternalRepository */
    protected $creatorInternalRepository;

    /** @var CreatorExternalRepository */
    protected $creatorExternalRepository;

    /** @var AdministrativeUnitRepository */
    protected $administrativeUnitRepository;

    /** @var ResearchUnitRepository */
    protected $researchUnitRepository;

    /** @var ProjectRepository */
    protected $projectRepository;

    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    /** @var StrategyCategoryRepository */
    protected $strategyCategoryRepository;

    /** @var StrategyRepository */
    protected $strategyRepository;

    /** @var FinancingTypeRepository */
    protected $financingTypeRepository;

    /** @var PriorityToolRepository */
    protected $priorityToolRepository;

    /** @var SecretProtectionMeasureRepository */
    protected $secretProtectionMeasureRepository;

    /**
     * @param AdministrativeUnitRepository $administrativeUnitRepository
     * @param ResearchUnitRepository $researchUnitRepository
     * @param ProjectRepository $projectRepository
     * @param IntangibleAssetRepository $intangibleAssetRepository 
     * 
     * @return void
     */
    public function __construct(
        UserRepository $userRepository,
        CreatorInternalRepository $creatorInternalRepository,
        CreatorExternalRepository $creatorExternalRepository,

        AdministrativeUnitRepository $administrativeUnitRepository,
        ResearchUnitRepository $researchUnitRepository,
        ProjectRepository $projectRepository,
        IntangibleAssetRepository $intangibleAssetRepository,

        StrategyCategoryRepository $strategyCategoryRepository,
        StrategyRepository $strategyRepository,
        FinancingTypeRepository $financingTypeRepository,
        PriorityToolRepository $priorityToolRepository,
        SecretProtectionMeasureRepository $secretProtectionMeasureRepository,

    ) {
        $this->userRepository = $userRepository;
        $this->creatorInternalRepository = $creatorInternalRepository;
        $this->creatorExternalRepository = $creatorExternalRepository;

        $this->administrativeUnitRepository = $administrativeUnitRepository;
        $this->researchUnitRepository = $researchUnitRepository;
        $this->projectRepository = $projectRepository;
        $this->intangibleAssetRepository = $intangibleAssetRepository;

        $this->strategyCategoryRepository = $strategyCategoryRepository;
        $this->strategyRepository = $strategyRepository;
        $this->financingTypeRepository = $financingTypeRepository;
        $this->priorityToolRepository = $priorityToolRepository;
        $this->secretProtectionMeasureRepository = $secretProtectionMeasureRepository;
    }

    public function compose(View $view)
    {
        $userCount = $this->userRepository->all()->count();
        $creatorInternalCount = $this->creatorInternalRepository->all()->count();
        $creatorExternalCount = $this->creatorExternalRepository->all()->count();

        $administrativeUnitCount = $this->administrativeUnitRepository->all()->count();
        $researchUnitCount = $this->researchUnitRepository->all()->count();
        $projectCount = $this->projectRepository->all()->count();
        $intangibleAssetCount = $this->intangibleAssetRepository->all()->count();

        $strategyCategoryCount = $this->strategyCategoryRepository->all()->count();
        $strategyCount = $this->strategyRepository->all()->count();
        $financingTypeCount = $this->financingTypeRepository->all()->count();
        $priorityToolCount = $this->priorityToolRepository->all()->count();
        $secretProtectionMeasureCount = $this->secretProtectionMeasureRepository->all()->count();

        $view->with(compact(
            'userCount',
            'creatorInternalCount',
            'creatorExternalCount',

            'administrativeUnitCount',
            'researchUnitCount',
            'projectCount',
            'intangibleAssetCount',

            'strategyCategoryCount',
            'strategyCount',
            'financingTypeCount',
            'priorityToolCount',
            'secretProtectionMeasureCount'
        ));
    }
}
