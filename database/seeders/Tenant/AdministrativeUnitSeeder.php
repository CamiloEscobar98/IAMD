<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;

use App\Repositories\Tenant\AdministrativeUnitRepository;

class AdministrativeUnitSeeder extends Seeder
{
    /** @var AdministrativeUnitRepository */
    protected $administrativeUnitRepository;
    
    public function __construct(AdministrativeUnitRepository $administrativeUnitRepository)
    {
        $this->administrativeUnitRepository = $administrativeUnitRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->administrativeUnitRepository->createFactory(10);
    }
}
