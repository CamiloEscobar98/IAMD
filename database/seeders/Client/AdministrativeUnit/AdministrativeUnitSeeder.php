<?php

namespace Database\Seeders\Client\AdministrativeUnit;

use Illuminate\Database\Seeder;

use App\Repositories\Client\AdministrativeUnitRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class AdministrativeUnitSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var AdministrativeUnitRepository */
    protected $administrativeUnitRepository;

    public function __construct(AdministrativeUnitRepository $administrativeUnitRepository)
    {
        $this->administrativeUnitRepository = $administrativeUnitRepository;
        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!isProductionEnv()) {
            $administrativeUnitNum = (int)$this->command->ask("¿Cuántas Facultades desea crear para el ambiente de desarrollo? \nPor defecto se crearán 10 facultades.", 10);
            $administrativeUnitNum = !is_numeric($administrativeUnitNum) || $administrativeUnitNum <= 0 ? 10 : $administrativeUnitNum;
            $administrativeUnits = \App\Models\Client\AdministrativeUnit::factory()->count($administrativeUnitNum)->make();

            $this->command->getOutput()->progressStart(count($administrativeUnits));

            foreach ($administrativeUnits as $administrativeUnit) {
                sleep(1);
                $this->info("\n-Creando Facultad: '{$administrativeUnit->name}'\n");
                $administrativeUnit->save();
                $this->command->getOutput()->progressAdvance();
            }
            $this->command->getOutput()->progressFinish();
        } else {
            $this->warn("Este Seeder no está desarrollado para implementarse en un ambiente productivo.");
        }
    }
}
