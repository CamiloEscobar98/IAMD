<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Seeder;

use App\Repositories\Admin\AssignmentContractRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class AssignmentContractSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var AssignmentContractRepository */
    protected $assignmentContractRepository;

    public function __construct(AssignmentContractRepository $assignmentContractRepository)
    {
        $this->assignmentContractRepository = $assignmentContractRepository;
        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $assignmentContracts = [
            [
                'name' => 'Cátedra',
                'is_internal' => true
            ],
            [
                'name' => 'Prestación de servicios',
                'is_internal' => true
            ],
            [
                'name' => 'Convenio',
                'is_internal' => true
            ],
            [
                'name' => 'Contrato o Término Fijo',
                'is_internal' => false
            ],
            [
                'name' => 'Contrato o Término Indefinido',
                'is_internal' => false
            ]
        ];
        
        $this->command->getOutput()->progressStart(count($assignmentContracts));

        foreach ($assignmentContracts as $assignmentContractItem) {
            $this->info("\n-Creando Tipo de Contratación para Creadores: '{$assignmentContractItem['name']}'\n");
            sleep(1);
            $this->assignmentContractRepository->create($assignmentContractItem);
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
