<?php

namespace Database\Seeders\Client;

use Illuminate\Database\Seeder;

use App\Repositories\Client\FinancingTypeRepository;

class FinancingTypeSeeder extends Seeder
{
    /** @var FinancingTypeRepository */
    protected $financingTypeRepository;

    public function __construct(FinancingTypeRepository $financingTypeRepository)
    {
        $this->financingTypeRepository = $financingTypeRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->financingTypeRepository->create([
            'name' => 'Fondo de Investigaciones Universitarias',
            'code' => 'FN',
        ]);
        $this->financingTypeRepository->create([
            'name' => 'Proyecto Institucional',
            'code' => 'PI',
        ]);
        $this->financingTypeRepository->create([
            'name' => 'Cofinanciación Externa',
            'code' => 'CE',
        ]);
        $this->financingTypeRepository->create([
            'name' => 'Contratación de Servicios',
            'code' => 'CS',
        ]);
    }
}
