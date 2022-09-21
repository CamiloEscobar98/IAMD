<?php

namespace Database\Seeders\Client;

use App\Repositories\Client\StrategyCategoryRepository;
use Illuminate\Database\Seeder;

class StrategyCategorySeeder extends Seeder
{
    /** @var StrategyCategoryRepository */
    protected $strategyCategoryRepository;

    public function __construct(StrategyCategoryRepository $strategyCategoryRepository)
    {
        $this->strategyCategoryRepository = $strategyCategoryRepository;
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

        print("¡¡ CREATING PRIORITY STRATEGIES CATEGORY !! \n \n");

        $cont = 0;

        foreach ($strategyCategories as $value) {

            $current = $cont + 1;

            print("Creating Strategy Category: $current. \n");

            $strategyCategory = $this->strategyCategoryRepository->createOneFactory([
                'name' => $value
            ]);

            print("Strategy Category Created. Name: " . $strategyCategory->name . "\n \n");

            $cont++;
        }

        print("PRIORITY STRATEGIES CATEGORY FINISHED. \n \n");
    }
}
