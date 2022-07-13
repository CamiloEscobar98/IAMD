<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;

use App\Repositories\Tenant\ResearchUnitCategoryRepository;

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
        $this->researchUnitCategoryRepository->create([
            'name' => 'Grupo de Investigación',
        ]);

        $this->researchUnitCategoryRepository->create([
            'name' => 'Semillero de Investigación',
        ]);

        $this->researchUnitCategoryRepository->create([
            'name' => 'Dependencia Administrativa',
        ]);

        $this->researchUnitCategoryRepository->create([
            'name' => 'Centro de Investigación',
        ]);

        $this->researchUnitCategoryRepository->create([
            'name' => 'Instituto de Investigación',
        ]);
    }
}
