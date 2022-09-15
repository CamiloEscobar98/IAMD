<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Seeder;

use App\Repositories\Admin\AssignmentContractRepository;

class AssignmentContractSeeder extends Seeder
{
    /** @var AssignmentContractRepository */
    protected $assignmentContractRepository;

    public function __construct(AssignmentContractRepository $assignmentContractRepository)
    {
        $this->assignmentContractRepository = $assignmentContractRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        print("¡¡ CREATING ASSIGNMENT CONTRACTS !! \n \n");

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

        $cont = 0;

        foreach ($assignmentContracts as $assignmentContractItem) {
            $current = $cont + 1;

            print("Creating Assignment Contract: $current. \n");

            $assignmentContract = $this->assignmentContractRepository->create(
                $assignmentContractItem
            );
            print("Assignment Contract Created. Name: " . $assignmentContract->name .  "\n \n");

            $cont++;
        }

        print("¡¡ ASSIGNMENT CONTRACTS CREATED !! \n \n");
    }
}
