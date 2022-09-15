<?php

namespace Database\Seeders\Client;

use Illuminate\Database\Seeder;

use App\Repositories\Client\ProjectContractTypeRepository;

class ProjectContractTypeSeeder extends Seeder
{
    /** @var ProjectContractTypeRepository */
    protected $projectContractTypeRepository;

    public function __construct(ProjectContractTypeRepository $projectContractTypeRepository)
    {
        $this->projectContractTypeRepository = $projectContractTypeRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->projectContractTypeRepository->create([
            'name' => 'Número de Contrato de  Cofinanciación',
        ]);
        $this->projectContractTypeRepository->create([
            'name' => 'Número del acta',
            'code' => 'A',
        ]);
        $this->projectContractTypeRepository->create([
            'name' => 'Número de Contrato/Convenio',
            'code' => 'CN',
        ]);
        $this->projectContractTypeRepository->create([
            'name' => 'Contrato OPS',
        ]);
    }
}
