<?php

namespace App\Http\ViewComposers\Client;

use Illuminate\View\View;

use App\Repositories\Client\UserRepository;
use App\Repositories\Client\CreatorExternalRepository;
use App\Repositories\Client\CreatorInternalRepository;

use App\Repositories\Client\AdministrativeUnitRepository;
use App\Repositories\Client\AcademicDepartmentRepository;
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

    /** @var AcademicDepartmentRepository */
    protected $academicDepartmentRepository;

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
        AcademicDepartmentRepository $academicDepartmentRepository,
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
        $this->academicDepartmentRepository = $academicDepartmentRepository;
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
        $userCount = $this->userRepository->count();
        $creatorInternalCount = $this->creatorInternalRepository->count();
        $creatorExternalCount = $this->creatorExternalRepository->count();

        $administrativeUnitCount = $this->administrativeUnitRepository->count();
        $academicDepartmentCount = $this->academicDepartmentRepository->count();
        
        $researchUnitCount = $this->researchUnitRepository->count();
        $projectCount = $this->projectRepository->count();
        $intangibleAssetCount = $this->intangibleAssetRepository->count();

        $strategyCategoryCount = $this->strategyCategoryRepository->count();
        $strategyCount = $this->strategyRepository->count();
        $financingTypeCount = $this->financingTypeRepository->count();
        $priorityToolCount = $this->priorityToolRepository->count();
        $secretProtectionMeasureCount = $this->secretProtectionMeasureRepository->count();

        $view->with(compact(
            'userCount',
            'creatorInternalCount',
            'creatorExternalCount',

            'administrativeUnitCount',
            'academicDepartmentCount',
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
