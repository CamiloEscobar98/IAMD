<?php

namespace Database\Seeders\Client\Strategy;

use Illuminate\Database\Seeder;

use App\Repositories\Client\StrategyRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class StrategySeeder extends Seeder
{
    use InteractsWithIO;

    /** @var StrategyRepository */
    protected $strategyRepository;

    public function __construct(StrategyRepository $strategyRepository)
    {
        $this->strategyRepository = $strategyRepository;
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
            $strategyNum = (int)$this->command->ask("¿Cuántas Estrategias de Gestión desea crear para el ambiente de desarrollo? \nPor defecto se crearán 15 Estrategias de Gestión.", 15);
            $strategyNum = !is_numeric($strategyNum) || $strategyNum <= 0 ? 15 : $strategyNum;
            $strategies = \App\Models\Client\Strategy::factory()->count($strategyNum)->make();

            $this->command->getOutput()->progressStart(count($strategies));

            foreach ($strategies as $strategy) {
                $this->info("\n-Creando Estrategia de Gestión: '{$strategy->name}'\n");
                $strategy->save();
                $this->command->getOutput()->progressAdvance();
            }
            $this->command->getOutput()->progressFinish();
        } else {
            $this->warn("Este Seeder no está desarrollado para implementarse en un ambiente productivo.");
        }
    }
}
