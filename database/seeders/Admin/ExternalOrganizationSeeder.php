<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Seeder;

use App\Repositories\Admin\ExternalOrganizationRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class ExternalOrganizationSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var ExternalOrganizationRepository */
    protected $externalOrganizationRepository;

    public function __construct(ExternalOrganizationRepository $externalOrganizationRepository)
    {
        $this->externalOrganizationRepository = $externalOrganizationRepository;
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
            $externalOrganizationsNum = (int)$this->command->ask("¿Cuántas Organizaciones Externas desea crear para el ambiente de desarrollo? \nPor defecto se crearán 10 empresas.", 40);
            $externalOrganizationsNum = !is_numeric($externalOrganizationsNum) || $externalOrganizationsNum <= 0 ? 40 : $externalOrganizationsNum;
            $externalOrganizations = \App\Models\Admin\ExternalOrganization::factory()->count($externalOrganizationsNum)->make();

            $this->command->getOutput()->progressStart(count($externalOrganizations));

            foreach ($externalOrganizations as $externalOrganizationItem) {
                sleep(1);
                $this->info("\n-Creando Organización Externa: '{$externalOrganizationItem->name}'\n");
                $externalOrganizationItem->save();
                $this->command->getOutput()->progressAdvance();
            }
            $this->command->getOutput()->progressFinish();
        } else {
            $this->warn("Este Seeder no está desarrollado para implementarse en un ambiente productivo.");
        }
    }
}
