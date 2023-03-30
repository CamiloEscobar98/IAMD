<?php

namespace Database\Seeders\Client;

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Collection;

use App\Repositories\Admin\IntellectualPropertyRightSubcategoryRepository;
use App\Repositories\Admin\IntellectualPropertyRightProductRepository;

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
use App\Repositories\Client\IntangibleAssetAcademicRecordRepository;
use App\Repositories\Client\IntangibleAssetConfidentialityContractRepository;
use App\Repositories\Client\IntangibleAssetContabilityRepository;
use App\Repositories\Client\IntangibleAssetDpiPriorityToolRepository;
use App\Repositories\Client\IntangibleAssetLocalizationRepository;
use App\Repositories\Client\IntangibleAssetSecretProtectionMeasureRepository;
use App\Repositories\Client\IntangibleAssetSessionRightContractRepository;
use App\Repositories\Client\IntangibleAssetStrategyRepository;
use App\Repositories\Client\PriorityToolRepository;
use App\Repositories\Client\SecretProtectionMeasureRepository;
use App\Repositories\Client\StrategyCategoryRepository;
use App\Repositories\Client\StrategyRepository;
use App\Repositories\Client\UserRepository;
use App\Services\Client\IntangibleAssetService;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class IntangibleAssetSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var IntangibleAssetService */
    protected $intangibleAssetService;

    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    /** @var IntangibleAssetLocalizationRepository */
    protected $intangibleAssetLocalizationRepository;

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

    /** @var IntangibleAssetAcademicRecordRepository */
    protected $intangibleAssetAcademicRecordRepository;

    /** @var IntangibleAssetContabilityRepository */
    protected $intangibleAssetContabilityRepository;

    /** @var IntellectualPropertyRightSubcategoryRepository */
    protected $intellectualPropertyRightSubcategoryRepository;

    /** @var IntellectualPropertyRightProductRepository */
    protected $intellectualPropertyRightProductRepository;

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
        IntangibleAssetService $intangibleAssetService,
        IntangibleAssetRepository $intangibleAssetRepository,
        IntangibleAssetLocalizationRepository $intangibleAssetLocalizationRepository,
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
        IntangibleAssetAcademicRecordRepository $intangibleAssetAcademicRecordRepository,
        IntangibleAssetContabilityRepository $intangibleAssetContabilityRepository,

        IntellectualPropertyRightSubcategoryRepository $intellectualPropertyRightSubcategoryRepository,
        IntellectualPropertyRightProductRepository $intellectualPropertyRightProductRepository,

        ProjectRepository $projectRepository,
        CreatorRepository $creatorRepository,
        UserRepository $userRepository,

        SecretProtectionMeasureRepository $secretProtectionMeasureRepository,
        PriorityToolRepository $priorityToolRepository,
        StrategyCategoryRepository $strategyCategoryRepository,
        StrategyRepository $strategyRepository,
    ) {
        $this->intangibleAssetService = $intangibleAssetService;
        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->intangibleAssetLocalizationRepository = $intangibleAssetLocalizationRepository;
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
        $this->intangibleAssetAcademicRecordRepository = $intangibleAssetAcademicRecordRepository;
        $this->intangibleAssetContabilityRepository = $intangibleAssetContabilityRepository;

        $this->intellectualPropertyRightSubcategoryRepository =  $intellectualPropertyRightSubcategoryRepository;
        $this->intellectualPropertyRightProductRepository = $intellectualPropertyRightProductRepository;

        $this->projectRepository = $projectRepository;
        $this->creatorRepository = $creatorRepository;
        $this->userRepository = $userRepository;

        $this->secretProtectionMeasureRepository = $secretProtectionMeasureRepository;
        $this->priorityToolRepository = $priorityToolRepository;
        $this->strategyCategoryRepository = $strategyCategoryRepository;
        $this->strategyRepository = $strategyRepository;

        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!isProductionEnv()) {
            /** Searching All Projects. */
            $projects = $this->projectRepository->all();

            /** Searching Intangible Asset States */
            $states = $this->intangibleAssetStateRepository->all();

            /** Searching Creators */
            $creators = $this->creatorRepository->all();

            /** Searching DPIS */
            $dpis = $this->intellectualPropertyRightSubcategoryRepository->all();

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

            $intangibleAssetNum = (int)$this->command->ask("¿Cuántas Activos Intangibles desea crear para el ambiente de desarrollo?", 1);
            $intangibleAssetNum = !is_numeric($intangibleAssetNum) || $intangibleAssetNum <= 0 ? 10 : $intangibleAssetNum;

            $this->command->getOutput()->progressStart($intangibleAssetNum);

            for ($i = 0; $i < $intangibleAssetNum; $i++) {
                sleep(1);

                /** @var \App\Models\Client\Project\Project $projectRandom */
                $projectRandom = $projects->random(1)->first();

                /** @var \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset */
                $intangibleAsset = $this->intangibleAssetRepository->createOneFactory([
                    'project_id' => $projectRandom->id,
                ]);

                $this->info("\n-Creando Activo Intangible: '{$intangibleAsset->name}'");

                /** @var \Illuminate\Database\Eloquent\Collection $researchUnits */
                $researchUnits = $projectRandom->research_units;
                $researchUnitsRandom = $researchUnits->random(rand(1, $researchUnits->count() - 1));

                $intangibleAsset->research_units()->sync($researchUnitsRandom);

                $this->intangibleAssetLocalizationRepository->createOneFactory(['intangible_asset_id' => $intangibleAsset->id]);

                $randomAllCompleted = (bool) rand(0, 1);

                $this->randomPhases($randomAllCompleted, $intangibleAsset, $states, $dpis, $creators, $users, $secretProtectionMeasures, $strategyCategories, $strategies, $priorityTools);

                $this->command->getOutput()->progressAdvance();
            }
            $this->command->getOutput()->progressFinish();
        } else {
            $this->warn("Este Seeder no está desarrollado para implementarse en un ambiente productivo.");
        }
    }

    /**
     * @param bool $randomAllCompleted
     * 
     * @return void
     */
    private function randomPhases(bool $randomAllCompleted, $intangibleAsset, $states, $dpis, $creators, $users, $secretProtectionMeasures, $strategyCategories, $strategies, $priorityTools): void
    {
        $randomHasClassification = true;
        $randomHasState = true;
        $randomHasDpis = true;
        $isPublished = true;
        $hasConfidencialityContract = true;
        $hasCreators = true;
        $hasSessionRightContract = true;
        $hasAcademicRecord = true;
        $hasContability = true;
        $hasComments = true;
        $hasProtectionAction = true;
        $hasSecretProtectionMeasures = true;
        $hasPriorityTools = true;
        $updateIsCommercial = true;
        $hasStrategies = true;
        $randomHasDescription = true;

        if (!$randomAllCompleted) {
            $randomHasClassification = (bool) rand(0, 1);
            $randomHasState = (bool) rand(0, 1);
            $randomHasDpis = (bool) rand(0, 1);
            $isPublished = (bool) rand(0, 1);
            $hasCreators = (bool) rand(0, 1);
            $hasConfidencialityContract = (bool) rand(0, 1);
            $hasSessionRightContract = (bool) rand(0, 1);
            $hasAcademicRecord = (bool) rand(0, 1);
            $hasContability = (bool) rand(0, 1);
            $hasComments = (bool) rand(0, 1);
            $hasProtectionAction = (bool) rand(0, 1);
            $hasSecretProtectionMeasures = (bool) rand(0, 1);
            $hasPriorityTools = (bool) rand(0, 1);
            $updateIsCommercial = (bool) rand(0, 1);
            $hasStrategies = (bool) rand(0, 1);
            $randomHasDescription = (bool) rand(0, 1);
        }

        /** Phase One */
        if ($randomHasClassification) $this->updateHasClassification($intangibleAsset);
        /** ./Phase One */

        /** Phase Two */
        if ($randomHasDescription) $this->updateHasDescription($intangibleAsset);
        /** ./Phase Two */

        /** Phase Three */
        if ($randomHasState) $this->updateHasState($intangibleAsset, $states);
        /** ./Phase Three */

        /** Phase Four */
        if ($randomHasDpis) $this->updateHasDPIS($intangibleAsset, $dpis);
        /** ./Phase Four */

        /** Phase Five */
        if ($isPublished && showIsPublishedInForm($intangibleAsset))   $this->updateHasBeenPublished($intangibleAsset, $states);

        if ($hasConfidencialityContract && showConfidencialityContractInForm($intangibleAsset))  $this->hasConfidencialityContract($intangibleAsset);

        if ($hasCreators)  $this->updateHasCreators($intangibleAsset, $creators);

        if ($hasSessionRightContract)  $this->hasSessionRightContract($intangibleAsset);

        if ($hasAcademicRecord && showAcademicRecordInForm($intangibleAsset)) $this->hasAcademicRecord($intangibleAsset);

        if ($hasContability && showContabilityInForm($intangibleAsset))  $this->hasContability($intangibleAsset);

        if ($isPublished && $hasConfidencialityContract && $hasCreators && $hasSessionRightContract && $hasContability) {
            $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'five', true);
        } elseif (!($isPublished && $hasConfidencialityContract && $hasCreators && $hasSessionRightContract && $hasContability)) {
            $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'five', false);
        } else {
            $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'five', null);
        }
        /** ./Phase Five */

        /** Phase Six */
        if ($hasComments) $this->updateHasComments($intangibleAsset, $users);
        /** ./Phase Six */

        /** Phase Seven */
        if ($hasProtectionAction) $this->hasProtectionAction($intangibleAsset);
        if ($hasSecretProtectionMeasures) $this->hasSecretProtectionMeasures($intangibleAsset, $secretProtectionMeasures);

        if ($hasProtectionAction && $hasSecretProtectionMeasures) {
            $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'seven', true);
        } elseif (!($hasProtectionAction && $hasSecretProtectionMeasures)) {
            $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'seven', false);
        } else {
            $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'seven', null);
        }
        /** ./Phase Seven */

        /** Phase Eight */
        if ($hasPriorityTools) $this->hasPriorityTools($intangibleAsset, $priorityTools);
        /** ./Phase Eight */

        /** Phase Nine */
        if ($updateIsCommercial) $this->updateIsCommercial($intangibleAsset, $states);
        /** ./Phase Nine */

        if ($hasStrategies) $this->hasStrategies($intangibleAsset, $strategyCategories, $strategies, $users);

        if ($randomAllCompleted) {
            $this->intangibleAssetService->generateCodeOfIntangibleAsset($intangibleAsset);
        }
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * 
     * @return void
     */
    private function updateHasClassification($intangibleAsset): void
    {
        $randomClassification = $this->intellectualPropertyRightProductRepository->randomFirst();

        $this->intangibleAssetRepository->update($intangibleAsset, ['classification_id' => $randomClassification->id]);

        $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'one');

        $this->comment("Este Activo Intangible tiene una clasificación: '{$randomClassification->name}'");
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * 
     * @return void
     */
    private function updateHasDescription($intangibleAsset): void
    {
        $faker = \Faker\Factory::create();

        $this->intangibleAssetRepository->update($intangibleAsset, [
            'description' => $faker->realText(200)
        ]);

        $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'two');

        $this->comment("Este Activo Intangible tiene una descripción");
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

        $this->comment("Este Activo Intangible tiene un Estado: '{$randomState->name}'");
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param Collection $users
     * 
     * @return void
     */
    private function updateHasComments($intangibleAsset, $users): void
    {
        $randomNumber = rand(1, $users->count() - 1);
        $randomUsers = $users->random($randomNumber);

        $randomUsers->each(function ($user) use ($intangibleAsset) {
            $this->intangibleAssetCommentRepository->createOneFactory([
                'intangible_asset_id' => $intangibleAsset->id,
                'user_id' => $user->id
            ]);
        });

        $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'six');

        $this->comment("Este Activo Intangible tiene comentarios");
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

        $this->comment("Este Activo ha sido publicado o divulgado: '{$assetPublished->published_at_by_default}'");
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

        $this->comment("Este Activo Intangible tiene una razón comercial: '{$assetCommercial->reason}'");
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
        $randomNumber = rand(1, $creators->count() - 1);

        $randomCreators = $creators->random($randomNumber);

        $intangibleAsset->creators()->sync($randomCreators);

        $this->comment("Este Activo Intangible está relacionado con '{$randomCreators->count()} Creadores'");
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

        $this->comment("Este Activo Intangible tiene Derechos de Propiedad Intelectual relacionados: '{$randomDPIS->count()} DPI'");
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

        $this->comment("Este Activo Intangible tiene Contrato de Confidencialidad ");
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

        $this->comment("Este Activo Intangible tiene Contrato de Sesión de Derechos Patrimoniales");
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * 
     * @return void
     */
    private function hasAcademicRecord($intangibleAsset): void
    {
        $this->intangibleAssetAcademicRecordRepository->createOneFactory([
            'intangible_asset_id' => $intangibleAsset->id
        ]);

        $this->comment("Este Activo Intangible tiene un Acto Administrativo");
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

        $this->comment("Este Activo Intangible tiene Contabilidad ");
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

        $this->comment("Este Activo Intangible toma medidas razonables para la protección de los secretos empresariales ");
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
        $this->comment("Este Activo Intangible tiene '{$randomSecretProtectionMeasures->count()}' Medidas Secretas de Protección");
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
            $randomNumber = rand(1, $priorityTools->count() - 1);
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

        $this->comment("Este Activo Intangible tiene Herramientas de Priorización");
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param Collection $strategyCategories
     * @param Collection $strategies
     * @param Collection $users
     * 
     * @return void
     */
    private function hasStrategies($intangibleAsset, $strategyCategories, $strategies, $users): void
    {
        $strategyCategories->each(function ($strategyCategory) use ($intangibleAsset, $strategies, $users) {
            if ((bool) rand(0, 1)) {
                $randomNumberStrategies = rand(1, $strategies->count() - 1);


                $randomStrategies = $strategies->random($randomNumberStrategies);

                foreach ($randomStrategies as $strategy) {
                    $randomUser = $users->random(1)->first();

                    $this->intangibleAssetStrategyRepository->create([
                        'intangible_asset_id' => $intangibleAsset->id,
                        'strategy_category_id' => $strategyCategory->id,
                        'strategy_id' => $strategy->id,
                        'user_id' => $randomUser->id
                    ]);
                }
            }
        });

        $this->intangibleAssetPhaseRepository->updateOrCreate(['intangible_asset_id' => $intangibleAsset->id], ['has_strategies' => true]);

        $this->comment("Este Activo Intangible tiene Estrategias de Gestión");
    }
}
