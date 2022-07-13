<?php

namespace Database\Seeders\Tenant;

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
        $administrativeUnits = $this->administrativeUnitRepository->all();
        $researchUnitCategories = $this->researchUnitCategoryRepository->all();
        $creators = $this->creatorRepository->all();


        $administrativeUnits->each(function ($administrativeUnit) use ($researchUnitCategories, $creators) {
            $randomNumber = rand(2, 5);

            do {
                $researchUnitCategory = $researchUnitCategories->random(1)->first();
                $director = $creators->random(1)->first();
                $inventoryManager = $creators->random(1)->first();

                $this->researchUnitRepository->createOneFactory([
                    'administrative_unit_id' => $administrativeUnit->id,
                    'research_unit_category_id' => $researchUnitCategory->id,
                    'director_id' => $director->id,
                    'inventory_manager_id' => $inventoryManager->id
                ]);

                $randomNumber--;
            } while ($randomNumber > 0);
        });
    }
}
