<?php

namespace Database\Seeders\Tenant;

use App\Repositories\IntangibleAssetStateRepository;
use Illuminate\Database\Seeder;

use App\Repositories\Tenant\IntangibleAssetRepository;
use App\Repositories\Tenant\ProjectRepository;

class IntangibleAssetSeeder extends Seeder
{
    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    /** @var IntangibleAssetStateRepository */
    protected $intangibleAssetStateRepository;

    /** @var ProjectRepository */
    protected $projectRepository;

    public function __construct(
        IntangibleAssetRepository $intangibleAssetRepository,
        IntangibleAssetStateRepository $intangibleAssetStateRepository,
        ProjectRepository $projectRepository
    ) {
        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;
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
     */
    public function updateHasState($intangibleAsset, $states)
    {
        $randomState = $states->random(1)->first();

        $this->intangibleAssetRepository->update($intangibleAsset, ['intangible_asset_state_id' => $randomState->id]);

        print("This Intangible Asset has a State. State: " . $randomState->name . "\n");
    }
}
