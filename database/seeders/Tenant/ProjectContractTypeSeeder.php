<?php

namespace Database\Seeders\Tenant;

use App\Repositories\Tenant\ProjectContractTypeRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
