<?php

namespace Database\Seeders\Client\ResearchUnit;

use App\Repositories\Client\AcademicDepartmentRepository;
use Illuminate\Database\Seeder;

use App\Repositories\Client\AdministrativeUnitRepository;
use App\Repositories\Client\CreatorRepository;
use App\Repositories\Client\ResearchUnitCategoryRepository;
use App\Repositories\Client\ResearchUnitRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class ResearchUnitSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var AdministrativeUnitRepository */
    protected $administrativeUnitRepository;

    /** @var ResearchUnitCategoryRepository */
    protected $researchUnitCategoryRepository;

    /** @var AcademicDepartmentRepository */
    protected $academicDepartmentRepository;

    /** @var CreatorRepository */
    protected $creatorRepository;

    /** @var ResearchUnitRepository */
    protected $researchUnitRepository;

    public function __construct(
        AdministrativeUnitRepository $administrativeUnitRepository,
        ResearchUnitCategoryRepository $researchUnitCategoryRepository,
        AcademicDepartmentRepository $academicDepartmentRepository,
        CreatorRepository $creatorRepository,
        ResearchUnitRepository $researchUnitRepository
    ) {
        $this->administrativeUnitRepository = $administrativeUnitRepository;
        $this->researchUnitCategoryRepository = $researchUnitCategoryRepository;
        $this->academicDepartmentRepository = $academicDepartmentRepository;
        $this->creatorRepository = $creatorRepository;
        $this->researchUnitRepository = $researchUnitRepository;
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
            $administrativeUnits = $this->administrativeUnitRepository->all();
            $researchUnitCategories = $this->researchUnitCategoryRepository->all();
            $academicDepartments = $this->academicDepartmentRepository->all();
            $creators = $this->creatorRepository->all();

            $researchUnitNum = (int)$this->command->ask("¿Cuántas Unidades Investigativas desea crear para el ambiente de desarrollo? \nPor defecto se crearán 10 Unidades Investigativas.", 10);
            $researchUnitNum = !is_numeric($researchUnitNum) || $researchUnitNum <= 0 ? 10 : $researchUnitNum;

            $this->command->getOutput()->progressStart($researchUnitNum);
            for ($i = 0; $i < $researchUnitNum; $i++) {
                /** @var \App\Models\Client\AdministrativeUnit $administrativeUnitRandom */
                $administrativeUnitRandom = $administrativeUnits->random(1)->first();
                /** @var \App\Models\Client\ResearchUnitCategory $researchUnitCategoryRandom */
                $researchUnitCategoryRandom = $researchUnitCategories->random(1)->first();
                /** @var \App\Models\Client\Creator\Creator $director */
                $director = $creators->random(1)->first();
                /** @var \App\Models\Client\Creator\Creator $inventoryManager */
                $inventoryManager = $creators->random(1)->first();
                /** @var \App\Models\Client\AcademicDepartment $academicDepartmentRandom */
                $academicDepartmentRandom = $academicDepartments->random(1)->first();

                $researchUnit = $this->researchUnitRepository->createOneFactory([
                    'administrative_unit_id' => $administrativeUnitRandom->id,
                    'research_unit_category_id' => $researchUnitCategoryRandom->id,
                    'academic_department_id' => (bool)rand(0, 1) ? $academicDepartmentRandom->id : null,
                    'director_id' => $director->id,
                    'inventory_manager_id' => $inventoryManager->id
                ]);
                $this->info("\n-Creando Unidad Investigativa: '{$researchUnit->name}'\n");
                $this->command->getOutput()->progressAdvance();
            }
            $this->command->getOutput()->progressFinish();
        } else {
            $this->warn("Este Seeder no está desarrollado para implementarse en un ambiente productivo.");
        }
    }
}
