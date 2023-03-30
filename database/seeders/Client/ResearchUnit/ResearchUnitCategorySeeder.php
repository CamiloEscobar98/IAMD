<?php

namespace Database\Seeders\Client\ResearchUnit;

use Illuminate\Database\Seeder;

use App\Repositories\Client\ResearchUnitCategoryRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class ResearchUnitCategorySeeder extends Seeder
{
    use InteractsWithIO;

    /** @var ResearchUnitCategoryRepository */
    protected $researchUnitCategoryRepository;

    public function __construct(ResearchUnitCategoryRepository $researchUnitCategoryRepository)
    {
        $this->researchUnitCategoryRepository = $researchUnitCategoryRepository;
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
            $researchUnitCategories = [
                'Grupo de Investigación',
                'Semillero de Investigación',
                'Dependencia Administrativa',
                'Centro de Investigación',
                'Instituto de Investigación',
            ];

            $this->command->getOutput()->progressStart(count($researchUnitCategories));

            foreach ($researchUnitCategories as $researchUnitCategoryName) {
                sleep(1);
                $this->info("\n-Creando Categoria de la Unidad de Investigación: '{$researchUnitCategoryName}'\n");
                $this->researchUnitCategoryRepository->create(['name' => $researchUnitCategoryName]);
                $this->command->getOutput()->progressAdvance();
            }
            $this->command->getOutput()->progressFinish();
        } else {
            $this->warn("Este Seeder no está desarrollado para implementarse en un ambiente productivo.");
        }
    }
}
