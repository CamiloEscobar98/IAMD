<?php

namespace Database\Seeders\Client\Creator;

use Illuminate\Database\Seeder;

use App\Repositories\Client\CreatorRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class CreatorSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var CreatorRepository */
    protected $creatorRepository;

    public function __construct(CreatorRepository $creatorRepository)
    {
        $this->creatorRepository = $creatorRepository;
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
            $creatorsNum = (int)$this->command->ask("¿Cuántas Creadores desea crear para el ambiente de desarrollo? \nPor defecto se crearán 50 creadores.", 50);
            $creatorsNum = !is_numeric($creatorsNum) || $creatorsNum <= 0 ? 50 : $creatorsNum;
            $creators = \App\Models\Client\Creator\Creator::factory()->count($creatorsNum)->make();
            $this->command->getOutput()->progressStart(count($creators));

            foreach ($creators as $creator) {
                $this->info("\n-Creando Creador: '{$creator->name}'\n");
                $creator->save();
                $this->command->getOutput()->progressAdvance();
            }
            $this->command->getOutput()->progressFinish();
        } else {
            $this->warn("Este Seeder no está desarrollado para implementarse en un ambiente productivo.");
        }
    }
}
