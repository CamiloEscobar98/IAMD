<?php

namespace Database\Seeders\Client\PriorityTool;

use App\Repositories\Client\PriorityToolRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Output\ConsoleOutput;

class PriorityToolSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var PriorityToolRepository */
    protected $priorityToolRepository;

    public function __construct(PriorityToolRepository $priorityToolRepository)
    {
        $this->priorityToolRepository = $priorityToolRepository;
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
            $priorityToolNum = (int)$this->command->ask("¿Cuántas Herramientas de Priorización desea crear para el ambiente de desarrollo? \nPor defecto se crearán 10 Herramientas de Priorización.", 10);
            $priorityToolNum = !is_numeric($priorityToolNum) || $priorityToolNum <= 0 ? 10 : $priorityToolNum;
            $priorityTools = \App\Models\Client\PriorityTool::factory()->count($priorityToolNum)->make();

            $this->command->getOutput()->progressStart(count($priorityTools));

            foreach ($priorityTools as $priorityTool) {
                $this->info("\n-Creando Herramienta de Priorización: '{$priorityTool->name}'\n");
                $priorityTool->save();
                $this->command->getOutput()->progressAdvance();
            }
            $this->command->getOutput()->progressFinish();
        } else {
            $this->warn("Este Seeder no está desarrollado para implementarse en un ambiente productivo.");
        }
    }
}
