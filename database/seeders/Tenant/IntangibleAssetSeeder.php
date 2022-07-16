<?php

namespace Database\Seeders\Tenant;

use App\Repositories\IntangibleAssetStateRepository;
use App\Repositories\Tenant\IntangibleAssetCommercialRepository;
use App\Repositories\Tenant\IntangibleAssetPublishedRepository;
use Illuminate\Database\Seeder;

use App\Repositories\Tenant\IntangibleAssetRepository;
use App\Repositories\Tenant\ProjectRepository;

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

    /** @var ProjectRepository */
    protected $projectRepository;

    public function __construct(
        IntangibleAssetRepository $intangibleAssetRepository,
        IntangibleAssetStateRepository $intangibleAssetStateRepository,
        IntangibleAssetCommercialRepository $intangibleAssetCommercialRepository,
        IntangibleAssetPublishedRepository $intangibleAssetPublishedRepository,
        ProjectRepository $projectRepository
    ) {
        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;
        $this->intangibleAssetCommercialRepository = $intangibleAssetCommercialRepository;
        $this->intangibleAssetPublishedRepository = $intangibleAssetPublishedRepository;
        $this->projectRepository = $projectRepository;
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

        print("¡¡ CREATING INTANGIBLE ASSETS !! \n \n");


        $projects->each(function ($project) use ($states) {
            $randomNumber = rand(4, 20);

            print("PROJECT: " . $project->name .  "\n");

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
    private function updateHasState($intangibleAsset, $states)
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
    public function updateHasBeenPublished($intangibleAsset)
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
    public function updateIsCommercial($intangibleAsset)
    {
        $assetCommercial = $this->intangibleAssetCommercialRepository->createOneFactory([
            'intangible_asset_id' => $intangibleAsset->id
        ]);

        print("This Intangible Asset is Commercial: Reason: " . $assetCommercial->reason . "\n");
    }
}
