<?php

namespace Database\Seeders\Client\Project;

use Illuminate\Database\Seeder;

use App\Repositories\Client\ProjectContractTypeRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class ProjectContractTypeSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var ProjectContractTypeRepository */
    protected $projectContractTypeRepository;

    public function __construct(ProjectContractTypeRepository $projectContractTypeRepository)
    {
        $this->projectContractTypeRepository = $projectContractTypeRepository;
        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projectContracts = [
            [
                'name' => 'Número de Contrato de  Cofinanciación',
            ],
            [
                'name' => 'Número del acta',
                'code' => 'A',
            ],
            [
                'name' => 'Número de Contrato/Convenio',
                'code' => 'CN',
            ],
            [
                'name' => 'Contrato OPS',
            ]
        ];
        $this->command->getOutput()->progressStart(count($projectContracts));

        foreach ($projectContracts as $projectContractType) {
            sleep(1);
            $this->info("\n-Creando Tipo de Contratación para Proyectos: '{$projectContractType['name']}'\n");
            $this->projectContractTypeRepository->create($projectContractType);
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
