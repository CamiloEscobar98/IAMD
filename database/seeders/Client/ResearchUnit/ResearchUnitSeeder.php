<?php

namespace Database\Seeders\Client\ResearchUnit;

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

    /** @var CreatorRepository */
    protected $creatorRepository;

    /** @var ResearchUnitRepository */
    protected $researchUnitRepository;

    public function __construct(
        AdministrativeUnitRepository $administrativeUnitRepository,
        ResearchUnitCategoryRepository $researchUnitCategoryRepository,
        CreatorRepository $creatorRepository,
        ResearchUnitRepository $researchUnitRepository
    ) {
        $this->administrativeUnitRepository = $administrativeUnitRepository;
        $this->researchUnitCategoryRepository = $researchUnitCategoryRepository;
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

        $administrativeUnits = $this->administrativeUnitRepository->all();
        $researchUnitCategories = $this->researchUnitCategoryRepository->all();
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

            $researchUnit = $this->researchUnitRepository->createOneFactory([
                'administrative_unit_id' => $randomAdministrativeUnit->id,
                'research_unit_category_id' => $researchUnitCategory->id,
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
