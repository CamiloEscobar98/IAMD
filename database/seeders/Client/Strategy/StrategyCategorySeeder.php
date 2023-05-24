<?php

namespace Database\Seeders\Client\Strategy;

use App\Repositories\Client\StrategyCategoryRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Output\ConsoleOutput;

class StrategyCategorySeeder extends Seeder
{
    use InteractsWithIO;

    /** @var StrategyCategoryRepository */
    protected $strategyCategoryRepository;

    public function __construct(StrategyCategoryRepository $strategyCategoryRepository)
    {
        $this->strategyCategoryRepository = $strategyCategoryRepository;
        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $strategyCategories = [
            'Estrategias de Gestión para el Contrato de Cesión',
            'Estrategias de Gestión para la Contabilidad',
            'Estrategias de Gestión del Presupuesto para el Plan de Priorización',
            'Estrategias de Gestión del Presupuesto Generales',
        ];

        if (!isProductionEnv()) {
            $this->command->getOutput()->progressStart(count($strategyCategories));

            foreach ($strategyCategories as $strategyCategoryName) {
                sleep(1);
                $this->info("\n-Creando Categoría de las Estrategias de Gestión: $strategyCategoryName\n");
                $this->strategyCategoryRepository->createOneFactory([
                    'name' => $strategyCategoryName
                ]);
                $this->command->getOutput()->progressAdvance();
            }
            $this->command->getOutput()->progressFinish();
        } else {
            $this->warn("Este Seeder no está desarrollado para implementarse en un ambiente productivo.");
        }
    }
}
