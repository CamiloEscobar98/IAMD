<?php

namespace Database\Seeders\Tenant\ResearchUnit;

use Illuminate\Database\Seeder;

use App\Repositories\Client\ResearchUnitCategoryRepository;

class ResearchUnitCategorySeeder extends Seeder
{
    /** @var ResearchUnitCategoryRepository */
    protected $researchUnitCategoryRepository;

    public function __construct(ResearchUnitCategoryRepository $researchUnitCategoryRepository)
    {
        $this->researchUnitCategoryRepository = $researchUnitCategoryRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        print("¡¡ CREATING RESEARCH UNIT CATEGORIES !! \n \n");

        $names = [
            'Grupo de Investigación',
            'Semillero de Investigación',
            'Dependencia Administrativa',
            'Centro de Investigación',
            'Instituto de Investigación',
        ];

        $cont = 0;

        foreach ($names as $value) {
            $current = $cont + 1;

            print("Creating Research Unit Category: $current. \n");

            $researchUnitCategory = $this->researchUnitCategoryRepository->create([
                'name' => $value,
            ]);

            print("Research Unit Category Created. Name: " . $researchUnitCategory->name .  "\n \n");

            $cont++;
        }

        print("¡¡ RESEARCH UNIT CATEGORIES CREATED !! \n \n");
    }
}
