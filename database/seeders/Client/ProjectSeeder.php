<?php

namespace Database\Seeders\Client;

use Illuminate\Database\Seeder;

use App\Repositories\Client\CreatorRepository;
use App\Repositories\Client\FinancingTypeRepository;
use App\Repositories\Client\ProjectContractTypeRepository;
use App\Repositories\Client\ProjectRepository;
use App\Repositories\Client\ResearchUnitRepository;
use App\Repositories\Client\ProjectFinancingRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class ProjectSeeder extends Seeder
{
    use InteractsWithIO;

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
            /** Searching all Creators */
            $creators = $this->creatorRepository->all();

            /** Searching all Research Units */
            $researchUnits = $this->researchUnitRepository->all();

            /** Searching Financing Types */
            $financingTypes = $this->financingTypeRepository->all();

            /** Searching Project Contract Types */
            $projectContractTypes = $this->projectContractTypeRepository->all();

            $projectNum = (int)$this->command->ask("¿Cuántas Proyectos desea crear para el ambiente de desarrollo? \nPor defecto se crearán 25 Proyectos.", 25);
            $projectNum = !is_numeric($projectNum) || $projectNum <= 0 ? 25 : $projectNum;

            $this->command->getOutput()->progressStart($projectNum);

            for ($i = 0; $i < $projectNum; $i++) {
                sleep(1);
                $researchUnitsRandom = $researchUnits->random(rand(1, $researchUnits->count() - 1));
                /** @var \App\Models\Client\Creator\Creator $director */
                $director = $creators->random(1)->first();
                /** @var \App\Models\Client\Project\ProjectContractType $projectContractType */
                $projectContractType = $projectContractTypes->random(1)->first();

                /** @var \App\Models\Client\Project\Project $project */
                $project = $this->projectRepository->createOneFactory([
                    'director_id' => $director->id,
                    'project_contract_type_id' => $projectContractType->id,
                ]);

                $project->research_units()->sync($researchUnitsRandom);

                $financingTypesRandom = $financingTypes->random(rand(1, $financingTypes->count() - 1));

                $project->project_financings()->sync($financingTypesRandom);

                $this->info("\n-Creando Proyecto: '{$project->name}'\n");
                $this->command->getOutput()->progressAdvance();
            }
            $this->command->getOutput()->progressFinish();
        } else {
            $this->warn("Este Seeder no está desarrollado para implementarse en un ambiente productivo.");
        }
    }
}
