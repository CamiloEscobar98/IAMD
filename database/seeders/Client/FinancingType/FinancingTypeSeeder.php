<?php

namespace Database\Seeders\Client\FinancingType;

use Illuminate\Database\Seeder;

use App\Repositories\Client\FinancingTypeRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class FinancingTypeSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var FinancingTypeRepository */
    protected $financingTypeRepository;

    public function __construct(FinancingTypeRepository $financingTypeRepository)
    {
        $this->financingTypeRepository = $financingTypeRepository;
        $this->output = new ConsoleOutput();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $financingTypes = [
            [
                'name' => 'Fondo de Investigaciones Universitarias',
                'code' => 'FN',
            ],
            [
                'name' => 'Proyecto Institucional',
                'code' => 'PI',
            ],
            [
                'name' => 'Cofinanciación Externa',
                'code' => 'CE',
            ],
            [
                'name' => 'Contratación de Servicios',
                'code' => 'CS',
            ]
        ];

        $this->command->getOutput()->progressStart(count($financingTypes));

        foreach ($financingTypes as $financingType) {
            sleep(1);
            $this->financingTypeRepository->create($financingType);
            $this->info("\n-Creando Tipo de Financiación para Proyectos: '{$financingType['name']}'\n");
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
