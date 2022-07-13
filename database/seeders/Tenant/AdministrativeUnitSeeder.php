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
        print("¡¡ CREATING ADMINISTRATIVE UNITS !! \n \n");

        $randomNumber = rand(10, 20);
        $cont = 0;

        do {
            $current = $cont + 1;

            print("Creating Administrative Unit: $current. \n");
            $administrativeUnit = $this->administrativeUnitRepository->createOneFactory();
            print("Administrative Unit Created. Name: " . $administrativeUnit->name .  "\n \n");

            $cont++;
            $randomNumber--;
        } while ($randomNumber > 0);

        print("¡¡ ADMINISTRATIVE UNITS CREATED !! \n \n");
    }
}
