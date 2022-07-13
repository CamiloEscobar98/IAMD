<?php

namespace Database\Seeders\Tenant\ResearchUnit;

use Illuminate\Database\Seeder;

use App\Repositories\Tenant\AdministrativeUnitRepository;
use App\Repositories\Tenant\CreatorRepository;
use App\Repositories\Tenant\ResearchUnitCategoryRepository;
use App\Repositories\Tenant\ResearchUnitRepository;

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


        $administrativeUnits->each(function ($administrativeUnit) use ($researchUnitCategories, $creators) {
            $randomNumber = rand(2, 5);
            $cont = 0;

            print("Research Units for Administrative Unit: " . $administrativeUnit->name . "\n \n");

            do {
                $current = $cont + 1;

                print("Creating Research Unit: $current. \n");
                $researchUnitCategory = $researchUnitCategories->random(1)->first();
                $director = $creators->random(1)->first();
                $inventoryManager = $creators->random(1)->first();

                $researchUnit = $this->researchUnitRepository->createOneFactory([
                    'administrative_unit_id' => $administrativeUnit->id,
                    'research_unit_category_id' => $researchUnitCategory->id,
                    'director_id' => $director->id,
                    'inventory_manager_id' => $inventoryManager->id
                ]);
                print("Research Unit Created. Name: " . $researchUnit->name .  "\n");
                print("Research Unit Category Name: " . $researchUnitCategory->name .  "\n");
                print("Director Name: " . $director->name .  "\n");
                print("Inventory Manager Name: " . $inventoryManager->name .  "\n \n");


                $cont++;
                $randomNumber--;
            } while ($randomNumber > 0);
        });

        print("¡¡ RESEARCH UNITS CREATED !! \n \n");
    }
}
