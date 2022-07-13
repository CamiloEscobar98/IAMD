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
        $creators = $this->creatorRepository->all();

        $researchUnits = $this->researchUnitRepository->all();

        $researchUnits->each(function ($researchUnit) use ($creators) {
            $randomNumber = rand(3, 6);

            do {
                $director = $creators->random(1)->first();
                $this->projectRepository->createOneFactory([
                    'research_unit_id' => $researchUnit->id,
                    'director_id' => $director->id
                ]);

                $randomNumber--;
            } while ($randomNumber > 0);
        });
    }
}
