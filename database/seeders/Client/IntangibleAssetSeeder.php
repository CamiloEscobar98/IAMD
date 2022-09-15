<?php

namespace Database\Seeders\Client;

use Illuminate\Database\Seeder;

use App\Repositories\Admin\IntangibleAssetTypeLevel3Repository;

use App\Repositories\Admin\IntangibleAssetStateRepository;

use App\Repositories\Client\IntangibleAssetCommercialRepository;
use App\Repositories\Client\IntangibleAssetPublishedRepository;
use App\Repositories\Client\IntangibleAssetCreatorRepository;
use App\Repositories\Client\IntangibleAssetCommentRepository;

use App\Repositories\Client\IntangibleAssetRepository;

use App\Repositories\Client\ProjectRepository;
use App\Repositories\Client\CreatorRepository;
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

    /** @var IntangibleAssetCreatorRepository */
    protected $intangibleAssetCreatorRepository;

    /** @var IntangibleAssetCommentRepository */
    protected $intangibleAssetCommentRepository;

    /** @var IntangibleAssetTypeLevel3Repository */
    protected $intangibleAssetTypeLevel3Repository;

    /** @var ProjectRepository */
    protected $projectRepository;

    /** @var CreatorRepository */
    protected $creatorRepository;

    /** @var UserRepository */
    protected $userRepository;

    public function __construct(
        IntangibleAssetRepository $intangibleAssetRepository,
        IntangibleAssetStateRepository $intangibleAssetStateRepository,
        IntangibleAssetCommercialRepository $intangibleAssetCommercialRepository,
        IntangibleAssetPublishedRepository $intangibleAssetPublishedRepository,
        IntangibleAssetCreatorRepository $intangibleAssetCreatorRepository,
        IntangibleAssetCommentRepository $intangibleAssetCommentRepository,

        IntangibleAssetTypeLevel3Repository $intangibleAssetTypeLevel3Repository,

        ProjectRepository $projectRepository,
        CreatorRepository $creatorRepository,
        UserRepository $userRepository,
    ) {
        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;
        $this->intangibleAssetCommercialRepository = $intangibleAssetCommercialRepository;
        $this->intangibleAssetPublishedRepository = $intangibleAssetPublishedRepository;
        $this->intangibleAssetCreatorRepository = $intangibleAssetCreatorRepository;
        $this->intangibleAssetCommentRepository = $intangibleAssetCommentRepository;

        $this->intangibleAssetTypeLevel3Repository = $intangibleAssetTypeLevel3Repository;

        $this->projectRepository = $projectRepository;
        $this->creatorRepository = $creatorRepository;
        $this->userRepository = $userRepository;
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

        /** Searching Users */
        $users = $this->userRepository->all();

        print("¡¡ CREATING INTANGIBLE ASSETS !! \n \n");


        $projects->each(function ($project) use ($states, $creators, $users) {
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

                (bool) rand(0, 1) ? $this->updateHasClassification($intangibleAsset) : null;

                (bool) rand(0, 1) ? $this->updateHasState($intangibleAsset, $states) : null;

                (bool) rand(0, 1) ? $this->updateHasComments($intangibleAsset, $users) : null;

                (bool) rand(0, 1) ? $this->updateHasBeenPublished($intangibleAsset, $states) : null;

                (bool) rand(0, 1) ? $this->updateIsCommercial($intangibleAsset, $states) : null;

                (bool) rand(0, 1) ? $this->updateHasCreators($intangibleAsset, $creators) : null;

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

        print("This Intangible Asset has a State. State: " . $randomClassification->name . "\n");
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param \Illuminate\Database\Eloquent\Collection $states
     * 
     * @return void
     */
    private function updateHasState($intangibleAsset, $states): void
    {
        $randomState = $states->random(1)->first();

        $this->intangibleAssetRepository->update($intangibleAsset, ['intangible_asset_state_id' => $randomState->id]);

        print("This Intangible Asset has a State. State: " . $randomState->name . "\n");
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param \Illuminate\Database\Eloquent\Collection $users
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

        print("This Intangible Asset is Commercial: Reason: " . $assetCommercial->reason . "\n");
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param \Illuminate\Database\Eloquent\Collection $creators
     * 
     * @return void
     */
    private function updateHasCreators($intangibleAsset, $creators): void
    {
        $randomNumber = rand(1, 10);

        $randomCreators = $creators->random($randomNumber);

        $cont = 0;

        foreach ($randomCreators as $creator) {
            $this->intangibleAssetCreatorRepository->create([
                'intangible_asset_id' => $intangibleAsset->id,
                'creator_id' => $creator->id,
            ]);
            $cont++;
        }

        print("This Intangible Asset has Creators: Count: " . $cont . "\n");
    }
}
