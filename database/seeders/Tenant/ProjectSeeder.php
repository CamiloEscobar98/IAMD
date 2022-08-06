<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;

use App\Repositories\Tenant\CreatorRepository;
use App\Repositories\Tenant\ProjectRepository;
use App\Repositories\Tenant\ResearchUnitRepository;

class ProjectSeeder extends Seeder
{
    /** @var ResearchUnitRepository */
    protected $researchUnitRepository;

    /** @var ProjectRepository */
    protected $projectRepository;

    /** @var CreatorRepository */
    protected $creatorRepository;

    public function __construct(
        ResearchUnitRepository $researchUnitRepository,
        ProjectRepository $projectRepository,
        CreatorRepository $creatorRepository
    ) {
        $this->researchUnitRepository = $researchUnitRepository;
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
        /** Searching all Creators */
        $creators = $this->creatorRepository->all();

        /** Searching all Research Units */
        $researchUnits = $this->researchUnitRepository->all();

        print("¡¡ CREATING PROJECTS !! \n \n");

        $researchUnits->each(function ($researchUnit) use ($creators) {
            $randomNumber = rand(3, 6);

            print("RESEARCH UNIT: " . $researchUnit->name .  "\n \n");

            $cont = 0;

            do {
                $current = $cont + 1;

                /** Searching random Creator for Director role */
                $director = $creators->random(1)->first();

                print("Creating Intangible Asset: $current. \n");

                $project = $this->projectRepository->createOneFactory([
                    'research_unit_id' => $researchUnit->id,
                    'director_id' => $director->id
                ]);

                print("Intangible Asset Created. Name: " . $project->name . "\n");

                $cont++;
                $randomNumber--;
            } while ($randomNumber > 0);

            print("PROJECTS FINISHED. \n \n");
        });
    }
}
