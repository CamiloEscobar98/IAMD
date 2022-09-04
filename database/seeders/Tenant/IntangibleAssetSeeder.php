<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;

use App\Repositories\Admin\IntangibleAssetStateRepository;
use App\Repositories\Client\IntangibleAssetCommercialRepository;
use App\Repositories\Client\IntangibleAssetPublishedRepository;
use App\Repositories\Client\IntangibleAssetCreatorRepository;

use App\Repositories\Client\IntangibleAssetRepository;
use App\Repositories\Client\ProjectRepository;
use App\Repositories\Client\CreatorRepository;

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

    /** @var ProjectRepository */
    protected $projectRepository;

    /** @var CreatorRepository */
    protected $creatorRepository;

    public function __construct(
        IntangibleAssetRepository $intangibleAssetRepository,
        IntangibleAssetStateRepository $intangibleAssetStateRepository,
        IntangibleAssetCommercialRepository $intangibleAssetCommercialRepository,
        IntangibleAssetPublishedRepository $intangibleAssetPublishedRepository,
        IntangibleAssetCreatorRepository $intangibleAssetCreatorRepository,
        ProjectRepository $projectRepository,
        CreatorRepository $creatorRepository
    ) {
        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;
        $this->intangibleAssetCommercialRepository = $intangibleAssetCommercialRepository;
        $this->intangibleAssetPublishedRepository = $intangibleAssetPublishedRepository;
        $this->intangibleAssetCreatorRepository = $intangibleAssetCreatorRepository;
        $this->projectRepository = $projectRepository;
        $this->creatorRepository = $creatorRepository;
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

        print("¡¡ CREATING INTANGIBLE ASSETS !! \n \n");


        $projects->each(function ($project) use ($states, $creators) {
            $randomNumber = rand(4, 20);

            print("PROJECT: " . $project->name .  "\n \n");

            $cont = 0;
            do {
                $current = $cont + 1;

                print("Creating Intangible Asset: $current. \n");

                $intangibleAsset = $this->intangibleAssetRepository->createOneFactory([
                    'project_id' => $project->id,
                ]);

                print("Intangible Asset Created. Name: " . $intangibleAsset->name . "\n");

                (bool) rand(0, 1) ? $this->updateHasState($intangibleAsset, $states) : null;

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
     * @param \Illuminate\Database\Eloquent\Model $intangibleAsset
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
     * @param \Illuminate\Database\Eloquent\Model $intangibleAsset
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
     * @param \Illuminate\Database\Eloquent\Model $intangibleAsset
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
     * @param \Illuminate\Database\Eloquent\Model $intangibleAsset
     * @param \Illuminate\Database\Eloquent\Collection $creators
     * 
     * @return void
     */
    private function updateHasCreators($intangibleAsset, $creators): void
    {
        $randomNumber = rand(1, $creators->count() - 1);

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
