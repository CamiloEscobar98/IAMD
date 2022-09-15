<?php

namespace Database\Seeders\Client;

use Illuminate\Database\Seeder;

use App\Repositories\Client\CreatorRepository;
use App\Repositories\Client\FinancingTypeRepository;
use App\Repositories\Client\ProjectContractTypeRepository;
use App\Repositories\Client\ProjectRepository;
use App\Repositories\Client\ResearchUnitRepository;
use App\Repositories\Client\ProjectFinancingRepository;

class ProjectSeeder extends Seeder
{
    /** @var ResearchUnitRepository */
    protected $researchUnitRepository;

    /** @var ProjectRepository */
    protected $projectRepository;

    /** @var CreatorRepository */
    protected $creatorRepository;

    /** @var ProjectFinancingRepository */
    protected $projectFinancingRepository;

    /** @var FinancingTypeRepository */
    protected $financingTypeRepository;

    /** @var ProjectContractTypeRepository */
    protected $projectContractTypeRepository;

    public function __construct(
        ResearchUnitRepository $researchUnitRepository,
        ProjectRepository $projectRepository,
        CreatorRepository $creatorRepository,

        ProjectFinancingRepository $projectFinancingRepository,
        FinancingTypeRepository $financingTypeRepository,
        ProjectContractTypeRepository $projectContractTypeRepository
    ) {
        $this->researchUnitRepository = $researchUnitRepository;
        $this->projectRepository = $projectRepository;
        $this->creatorRepository = $creatorRepository;
        $this->projectFinancingRepository = $projectFinancingRepository;

        $this->financingTypeRepository = $financingTypeRepository;
        $this->projectContractTypeRepository = $projectContractTypeRepository;
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

        /** Searching Financing Types */
        $financingTypes = $this->financingTypeRepository->all();

        /** Searching Project Contract Types */
        $projectContractTypes = $this->projectContractTypeRepository->all();

        print("¡¡ CREATING PROJECTS !! \n \n");

        $researchUnits->each(function ($researchUnit) use ($creators, $financingTypes, $projectContractTypes) {
            $randomNumber = rand(3, 6);

            print("RESEARCH UNIT: " . $researchUnit->name .  "\n \n");

            $cont = 0;

            do {
                $current = $cont + 1;

                /** Searching random Creator for Director role */
                $director = $creators->random(1)->first();

                print("Creating Project: $current. \n");

                $project = $this->projectRepository->createOneFactory([
                    'research_unit_id' => $researchUnit->id,
                    'director_id' => $director->id
                ]);

                print("Project Created. Name: " . $project->name . "\n");

                /** Creating Project Financing Information */
                print("Creating Project Financing Information. \n");

                $financingType = $financingTypes->random(1)->first();

                $projectContractType = $projectContractTypes->random(1)->first();

                $this->projectFinancingRepository->createOneFactory([
                    'project_id' => $project->id,
                    'financing_type_id' => $financingType->id,
                    'project_contract_type_id' => $projectContractType->id,
                ]);

                print("Project Financing Information created! \n");

                $cont++;
                $randomNumber--;
            } while ($randomNumber > 0);

            print("PROJECTS FINISHED. \n \n");
        });
    }
}
