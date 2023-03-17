<?php

namespace Database\Seeders\Client\ResearchUnit;

use App\Repositories\Client\AcademicDepartmentRepository;
use Illuminate\Database\Seeder;

use App\Repositories\Client\AdministrativeUnitRepository;
use App\Repositories\Client\CreatorRepository;
use App\Repositories\Client\ResearchUnitCategoryRepository;
use App\Repositories\Client\ResearchUnitRepository;

class ResearchUnitSeeder extends Seeder
{
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
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ResearchUnitCategorySeeder::class);

        print("¡¡ CREATING RESEARCH UNITS !! \n \n");

        $administrativeUnits = $this->administrativeUnitRepository->all(['id', 'name']);
        $researchUnitCategories = $this->researchUnitCategoryRepository->all(['id', 'name']);
        $academicDepartments = $this->academicDepartmentRepository->all(['id', 'name']);
        $creators = $this->creatorRepository->all();

        $randomNumberResearchUnits = rand(15, 30);

        $cont = 0;

        do {
            $randomAdministrativeUnit = $administrativeUnits->random(1)->first();
            print("Research Units for Administrative Unit: " . $randomAdministrativeUnit->name . "\n \n");

            $current = $cont + 1;

            print("Creating Research Unit: $current. \n");
            $researchUnitCategory = $researchUnitCategories->random(1)->first();
            $director = $creators->random(1)->first();
            $inventoryManager = $creators->random(1)->first();
            $academicDepartmentId = (bool)rand(0, 1) ? $academicDepartments->random(1)->first()->id : null;

            $researchUnit = $this->researchUnitRepository->createOneFactory([
                'administrative_unit_id' => $randomAdministrativeUnit->id,
                'research_unit_category_id' => $researchUnitCategory->id,
                'academic_department_id' => $academicDepartmentId,
                'director_id' => $director->id,
                'inventory_manager_id' => $inventoryManager->id
            ]);

            print("Research Unit Created. Name: " . $researchUnit->name .  "\n");
            print("Research Unit Category Name: " . $researchUnitCategory->name .  "\n");
            print("Director Name: " . $director->name .  "\n");
            print("Inventory Manager Name: " . $inventoryManager->name .  "\n \n");


            $cont++;
            $randomNumberResearchUnits--;
        } while ($randomNumberResearchUnits > 0);

        print("¡¡ RESEARCH UNITS CREATED !! \n \n");
    }
}
