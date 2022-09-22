<?php

namespace Database\Seeders\Client;

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Collection;

use App\Repositories\Admin\IntangibleAssetTypeLevel2Repository;
use App\Repositories\Admin\IntangibleAssetTypeLevel3Repository;

use App\Repositories\Client\IntangibleAssetRepository;
use App\Repositories\Admin\IntangibleAssetStateRepository;
use App\Repositories\Client\IntangibleAssetCommercialRepository;
use App\Repositories\Client\IntangibleAssetPublishedRepository;
use App\Repositories\Client\IntangibleAssetProtectionActionRepository;
use App\Repositories\Client\IntangibleAssetPhaseRepository;

use App\Repositories\Client\IntangibleAssetCreatorRepository;
use App\Repositories\Client\IntangibleAssetCommentRepository;
use App\Repositories\Client\IntangibleAssetDPIRepository;


use App\Repositories\Client\ProjectRepository;
use App\Repositories\Client\CreatorRepository;
use App\Repositories\Client\IntangibleAssetConfidentialityContractRepository;
use App\Repositories\Client\IntangibleAssetContabilityRepository;
use App\Repositories\Client\IntangibleAssetDpiPriorityToolRepository;
use App\Repositories\Client\IntangibleAssetSecretProtectionMeasureRepository;
use App\Repositories\Client\IntangibleAssetSessionRightContractRepository;
use App\Repositories\Client\IntangibleAssetStrategyRepository;
use App\Repositories\Client\PriorityToolRepository;
use App\Repositories\Client\SecretProtectionMeasureRepository;
use App\Repositories\Client\StrategyCategoryRepository;
use App\Repositories\Client\StrategyRepository;
use App\Repositories\Client\UserRepository;

class IntangibleAssetSeeder extends Seeder
{
    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    /** @var IntangibleAssetStateRepository */
    protected $intangibleAssetStateRepository;

    /** @var IntangibleAssetPublishedRepository */
    protected $intangibleAssetPublishedRepository;

    /** @var IntangibleAssetCommercialRepository */
    protected $intangibleAssetCommercialRepository;

    /** @var IntangibleAssetProtectionActionRepository */
    protected $intangibleAssetProtectionActionRepository;

    /** @var IntangibleAssetPhaseRepository */
    protected $intangibleAssetPhaseRepository;

    /** @var IntangibleAssetCreatorRepository */
    protected $intangibleAssetCreatorRepository;

    /** @var IntangibleAssetCommentRepository */
    protected $intangibleAssetCommentRepository;

    /** @var IntangibleAssetDPIRepository */
    protected $intangibleAssetDPIRepository;

    /** @var IntangibleAssetStrategyRepository */
    protected $intangibleAssetStrategyRepository;

    /** @var IntangibleAssetSecretProtectionMeasureRepository */
    protected $intangibleAssetSecretProtectionMeasureRepository;

    /** @var IntangibleAssetDpiPriorityToolRepository */
    protected $intangibleAssetDpiPriorityToolRepository;

    /** @var IntangibleAssetConfidentialityContractRepository */
    protected $intangibleAssetConfidentialityContractRepository;

    /** @var IntangibleAssetSessionRightContractRepository */
    protected $intangibleAssetSessionRightContractRepository;

    /** @var IntangibleAssetContabilityRepository */
    protected $intangibleAssetContabilityRepository;

    /** @var IntangibleAssetTypeLevel2Repository */
    protected $intangibleAssetTypeLevel2Repository;

    /** @var IntangibleAssetTypeLevel3Repository */
    protected $intangibleAssetTypeLevel3Repository;

    /** @var ProjectRepository */
    protected $projectRepository;

    /** @var CreatorRepository */
    protected $creatorRepository;

    /** @var UserRepository */
    protected $userRepository;

    /** Others */

    /** @var SecretProtectionMeasureRepository */
    protected $secretProtectionMeasureRepository;

    /** @var PriorityToolRepository */
    protected $priorityToolRepository;

    /** @var StrategyCategoryRepository */
    protected $strategyCategoryRepository;

    /** @var StrategyRepository */
    protected $strategyRepository;

    public function __construct(
        IntangibleAssetRepository $intangibleAssetRepository,
        IntangibleAssetStateRepository $intangibleAssetStateRepository,
        IntangibleAssetCommercialRepository $intangibleAssetCommercialRepository,
        IntangibleAssetPublishedRepository $intangibleAssetPublishedRepository,
        IntangibleAssetProtectionActionRepository $intangibleAssetProtectionActionRepository,
        IntangibleAssetPhaseRepository $intangibleAssetPhaseRepository,

        IntangibleAssetCreatorRepository $intangibleAssetCreatorRepository,
        IntangibleAssetCommentRepository $intangibleAssetCommentRepository,
        IntangibleAssetDPIRepository $intangibleAssetDPIRepository,
        IntangibleAssetSecretProtectionMeasureRepository $intangibleAssetSecretProtectionMeasureRepository,
        IntangibleAssetDpiPriorityToolRepository $intangibleAssetDpiPriorityToolRepository,
        IntangibleAssetStrategyRepository $intangibleAssetStrategyRepository,

        IntangibleAssetConfidentialityContractRepository $intangibleAssetConfidentialityContractRepository,
        IntangibleAssetSessionRightContractRepository $intangibleAssetSessionRightContractRepository,
        IntangibleAssetContabilityRepository $intangibleAssetContabilityRepository,

        IntangibleAssetTypeLevel2Repository $intangibleAssetTypeLevel2Repository,
        IntangibleAssetTypeLevel3Repository $intangibleAssetTypeLevel3Repository,

        ProjectRepository $projectRepository,
        CreatorRepository $creatorRepository,
        UserRepository $userRepository,

        SecretProtectionMeasureRepository $secretProtectionMeasureRepository,
        PriorityToolRepository $priorityToolRepository,
        StrategyCategoryRepository $strategyCategoryRepository,
        StrategyRepository $strategyRepository,
    ) {
        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;
        $this->intangibleAssetCommercialRepository = $intangibleAssetCommercialRepository;
        $this->intangibleAssetPublishedRepository = $intangibleAssetPublishedRepository;
        $this->intangibleAssetProtectionActionRepository = $intangibleAssetProtectionActionRepository;
        $this->intangibleAssetPhaseRepository = $intangibleAssetPhaseRepository;

        $this->intangibleAssetCreatorRepository = $intangibleAssetCreatorRepository;
        $this->intangibleAssetCommentRepository = $intangibleAssetCommentRepository;
        $this->intangibleAssetDPIRepository = $intangibleAssetDPIRepository;
        $this->intangibleAssetSecretProtectionMeasureRepository = $intangibleAssetSecretProtectionMeasureRepository;
        $this->intangibleAssetDpiPriorityToolRepository = $intangibleAssetDpiPriorityToolRepository;
        $this->intangibleAssetStrategyRepository = $intangibleAssetStrategyRepository;

        $this->intangibleAssetConfidentialityContractRepository = $intangibleAssetConfidentialityContractRepository;
        $this->intangibleAssetSessionRightContractRepository = $intangibleAssetSessionRightContractRepository;
        $this->intangibleAssetContabilityRepository = $intangibleAssetContabilityRepository;

        $this->intangibleAssetTypeLevel2Repository =  $intangibleAssetTypeLevel2Repository;
        $this->intangibleAssetTypeLevel3Repository = $intangibleAssetTypeLevel3Repository;

        $this->projectRepository = $projectRepository;
        $this->creatorRepository = $creatorRepository;
        $this->userRepository = $userRepository;

        $this->secretProtectionMeasureRepository = $secretProtectionMeasureRepository;
        $this->priorityToolRepository = $priorityToolRepository;
        $this->strategyCategoryRepository = $strategyCategoryRepository;
        $this->strategyRepository = $strategyRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** Searching All Projects. */
        $projects = $this->projectRepository->all();

        /** Searching Intangible Asset States */
        $states = $this->intangibleAssetStateRepository->all();

        /** Searching Creators */
        $creators = $this->creatorRepository->all();

        /** Searching DPIS */
        $dpis = $this->intangibleAssetTypeLevel2Repository->all();

        /** Searching Users */
        $users = $this->userRepository->all();

        /** Secret Protection Measures */
        $secretProtectionMeasures = $this->secretProtectionMeasureRepository->all();

        /** Priority Tools */
        $priorityTools = $this->priorityToolRepository->all();

        /** Strategy Categories */
        $strategyCategories = $this->strategyCategoryRepository->all();

        /** Strategies */
        $strategies = $this->strategyRepository->all();

        print("¡¡ CREATING INTANGIBLE ASSETS !! \n \n");


        $projects->each(function ($project) use ($states, $creators, $users, $dpis, $secretProtectionMeasures, $priorityTools, $strategyCategories, $strategies) {
            $randomNumber = rand(3, 10);

            print("PROJECT: " . $project->name .  "\n \n");

            $cont = 0;
            do {
                $current = $cont + 1;

                print("Creating Intangible Asset: $current. \n");

                $intangibleAsset = $this->intangibleAssetRepository->createOneFactory([
                    'project_id' => $project->id,
                ]);

                print("Intangible Asset Created. Name: " . $intangibleAsset->name . "\n");

                $this->intangibleAssetPhaseRepository->create(['intangible_asset_id' => $intangibleAsset->id]);

                /** Phase One */
                if ((bool) rand(0, 1)) $this->updateHasClassification($intangibleAsset);
                /** ./Phase One */

                /** Phase Two */

                /** ./Phase Two */

                /** Phase Three */
                if ((bool) rand(0, 1)) $this->updateHasState($intangibleAsset, $states);
                /** ./Phase Three */

                /** Phase Four */
                if ((bool) rand(0, 1)) $this->updateHasDPIS($intangibleAsset, $dpis);
                /** ./Phase Four */

                /** Phase Five */
                $isPublished = (bool) rand(0, 1);

                $hasConfidencialityContract = (bool) rand(0, 1);

                $hasCreators = (bool) rand(0, 1);

                $hasSessionRightContract = (bool) rand(0, 1);

                $hasContability = (bool) rand(0, 1);

                if ($isPublished)  $this->updateHasBeenPublished($intangibleAsset, $states);

                if ($hasConfidencialityContract)  $this->hasConfidencialityContract($intangibleAsset);

                if ($hasCreators)  $this->updateHasCreators($intangibleAsset, $creators);

                if ($hasSessionRightContract)  $this->hasSessionRightContract($intangibleAsset);

                if ($hasContability)  $this->hasContability($intangibleAsset);

                if ($isPublished || $hasConfidencialityContract || $hasCreators || $hasSessionRightContract || $hasContability) $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'five', null);
                /** ./Phase Five */

                /** Phase Six */
                if ((bool) rand(0, 1)) $this->updateHasComments($intangibleAsset, $users);
                /** ./Phase Six */

                /** Phase Seven */
                $hasProtectionAction = (bool) rand(0, 1);
                $hasSecretProtectionMeasures = (bool) rand(0, 1);

                if ($hasProtectionAction) $this->hasProtectionAction($intangibleAsset);
                if ($hasSecretProtectionMeasures) $this->hasSecretProtectionMeasures($intangibleAsset, $secretProtectionMeasures);

                if ($hasProtectionAction || $hasSecretProtectionMeasures) $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'seven', null);
                /** ./Phase Seven */

                /** Phase Eight */
                if ((bool) rand(0, 1)) $this->hasPriorityTools($intangibleAsset, $priorityTools);
                /** ./Phase Eight */

                /** Phase Nine */
                if ((bool) rand(0, 1)) $this->updateIsCommercial($intangibleAsset, $states);
                /** ./Phase Nine */

                if ((bool) rand(0, 1)) $this->hasStrategies($intangibleAsset, $strategyCategories, $strategies);

                print("\n \n");

                $cont++;
                $randomNumber--;
            } while ($randomNumber > 0);

            print("INTANGIBLE ASSET FINISHED. \n \n");
        });
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * 
     * @return void
     */
    public function updateHasClassification($intangibleAsset)
    {
        $randomClassification = $this->intangibleAssetTypeLevel3Repository->randomFirst();

        $this->intangibleAssetRepository->update($intangibleAsset, ['classification_id' => $randomClassification->id]);

        $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'one');

        print("This Intangible Asset has a State. State: " . $randomClassification->name . "\n");
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param Collection $states
     * 
     * @return void
     */
    private function updateHasState($intangibleAsset, $states): void
    {
        $randomState = $states->random(1)->first();

        $this->intangibleAssetRepository->update($intangibleAsset, ['intangible_asset_state_id' => $randomState->id]);

        $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'three');

        print("This Intangible Asset has a State. State: " . $randomState->name . "\n");
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param Collection $users
     * 
     * @return void
     */
    public function updateHasComments($intangibleAsset, $users): void
    {
        $randomNumber = rand(1, 10);
        $randomUsers = $users->random($randomNumber);

        $randomUsers->each(function ($user) use ($intangibleAsset) {
            $this->intangibleAssetCommentRepository->createOneFactory([
                'intangible_asset_id' => $intangibleAsset->id,
                'user_id' => $user->id
            ]);
        });

        $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'six');

        print("This Intangible Asset has comments! \n");
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * 
     * @return void
     */
    private function updateHasBeenPublished($intangibleAsset): void
    {
        $assetPublished = $this->intangibleAssetPublishedRepository->createOneFactory([
            'intangible_asset_id' => $intangibleAsset->id
        ]);

        print("This Intangible Asset has been published: At: " . $assetPublished->published_at_by_default . "\n");
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * 
     * @return void
     */
    private function updateIsCommercial($intangibleAsset): void
    {
        $assetCommercial = $this->intangibleAssetCommercialRepository->createOneFactory([
            'intangible_asset_id' => $intangibleAsset->id
        ]);

        $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'nine');

        print("This Intangible Asset is Commercial: Reason: " . $assetCommercial->reason . "\n");
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param Collection $creators
     * 
     * @return void
     */
    private function updateHasCreators($intangibleAsset, $creators): void
    {
        /**
         * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
         * 
         * @return void
         */
        $randomNumber = rand(1, 10);

        $randomCreators = $creators->random($randomNumber);

        foreach ($randomCreators as $creator) {
            $this->intangibleAssetCreatorRepository->create([
                'intangible_asset_id' => $intangibleAsset->id,
                'creator_id' => $creator->id,
            ]);
        }

        print("This Intangible Asset has Creators: Count: " . $randomCreators->count() . "\n");
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param Collection $dpis
     * 
     * @return void
     */
    private function updateHasDPIS($intangibleAsset, $dpis): void
    {
        $randomNumber = rand(1, $dpis->count() - 1);

        $randomDPIS = $dpis->random($randomNumber);

        foreach ($randomDPIS as $dpi) {
            $this->intangibleAssetDPIRepository->create([
                'intangible_asset_id' => $intangibleAsset->id,
                'dpi_id' => $dpi->id
            ]);
        }

        $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'four');

        print("This Intangible Asset has DPIS: Count: " . $randomDPIS->count() . "\n");
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * 
     * @return void
     */
    private function hasConfidencialityContract($intangibleAsset): void
    {
        $this->intangibleAssetConfidentialityContractRepository->createOneFactory([
            'intangible_asset_id' => $intangibleAsset->id
        ]);

        print("This Intangible Asset has Confidenciality Contract \n");
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * 
     * @return void
     */
    private function hasSessionRightContract($intangibleAsset): void
    {
        $this->intangibleAssetSessionRightContractRepository->createOneFactory([
            'intangible_asset_id' => $intangibleAsset->id
        ]);

        print("This Intangible Asset has Session Right Contract \n");
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * 
     * @return void
     */
    private function hasContability($intangibleAsset): void
    {
        $this->intangibleAssetContabilityRepository->createOneFactory([
            'intangible_asset_id' => $intangibleAsset->id
        ]);

        print("This Intangible Asset has Contability \n");
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * 
     * @return void
     */
    private function hasProtectionAction($intangibleAsset): void
    {
        $this->intangibleAssetProtectionActionRepository->createOneFactory([
            'intangible_asset_id' => $intangibleAsset->id
        ]);

        print("This Intangible Asset has Protection Action \n");
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param Collection $secretProtectionMeasures
     * 
     * @return void
     */
    private function hasSecretProtectionMeasures($intangibleAsset, $secretProtectionMeasures)
    {
        $randomNumber = rand(1, $secretProtectionMeasures->count() - 1);

        $randomSecretProtectionMeasures = $secretProtectionMeasures->random($randomNumber);

        foreach ($randomSecretProtectionMeasures as $secretProtectionMeasure) {
            $this->intangibleAssetSecretProtectionMeasureRepository->create([
                'intangible_asset_id' => $intangibleAsset->id,
                'secret_protection_measure_id' => $secretProtectionMeasure->id
            ]);
        }
        print("This Intangible Asset has Secret Protection Measures: Count: " . $randomSecretProtectionMeasures->count() . "\n");
    }


    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param Collection $priorityTools
     * 
     * @return void
     */
    private function hasPriorityTools($intangibleAsset, $priorityTools)
    {
        /** @var Collection */
        $dpis = $intangibleAsset->dpis;

        $dpis->each(function ($dpi) use ($intangibleAsset, $priorityTools) {
            $randomNumber = rand(1, $priorityTools->count() - 10);
            $randomTools = $priorityTools->random($randomNumber);

            foreach ($randomTools as $tool) {
                $this->intangibleAssetDpiPriorityToolRepository->create([
                    'intangible_asset_id' => $intangibleAsset->id,
                    'dpi_id' => $dpi->dpi_id,
                    'priority_tool_id' => $tool->id
                ]);
            }
        });

        $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'eight');

        print("This Intangible Asset has Priority Tools \n");
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param Collection $strategyCategories
     * @param Collection $strategies
     * 
     * @return void
     */
    private function hasStrategies($intangibleAsset, $strategyCategories, $strategies): void
    {
        $strategyCategories->each(function ($strategyCategory) use ($intangibleAsset, $strategies) {
            if ((bool) rand(0, 1)) {
                $randomNumber = rand(1, $strategies->count() - 1);

                $randomStrategies = $strategies->random($randomNumber);

                foreach ($randomStrategies as $strategy) {
                    $this->intangibleAssetStrategyRepository->create([
                        'intangible_asset_id' => $intangibleAsset->id,
                        'strategy_category_id' => $strategyCategory->id,
                        'strategy_id' => $strategy->id
                    ]);
                }
            }
        });

        print("This Intangible Asset has Strategies \n");
    }
}
