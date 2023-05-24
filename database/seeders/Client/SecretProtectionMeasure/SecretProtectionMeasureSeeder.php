<?php

namespace Database\Seeders\Client\SecretProtectionMeasure;

use App\Repositories\Client\SecretProtectionMeasureRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Output\ConsoleOutput;

class SecretProtectionMeasureSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var SecretProtectionMeasureRepository */
    protected $secretProtectionMeasureRepository;

    public function __construct(SecretProtectionMeasureRepository $secretProtectionMeasureRepository)
    {
        $this->secretProtectionMeasureRepository = $secretProtectionMeasureRepository;
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
            $secretProtectionMeasureNum = (int)$this->command->ask("¿Cuántas Medidas Secretas de Protección desea crear para el ambiente de desarrollo? \nPor defecto se crearán 10 Medidas Secretas de Protección.", 10);
            $secretProtectionMeasureNum = !is_numeric($secretProtectionMeasureNum) || $secretProtectionMeasureNum <= 0 ? 10 : $secretProtectionMeasureNum;
            $secretProtectionMeasures = \App\Models\Client\SecretProtectionMeasure::factory()->count($secretProtectionMeasureNum)->make();

            $this->command->getOutput()->progressStart(count($secretProtectionMeasures));

            foreach ($secretProtectionMeasures as $secretProtectionMeasure) {
                sleep(1);
                $this->info("\n-Creando Medida Secreta de Protección: '{$secretProtectionMeasure->name}'\n");
                $secretProtectionMeasure->save();
                $this->command->getOutput()->progressAdvance();
            }
            $this->command->getOutput()->progressFinish();
        } else {
            $this->warn("Este Seeder no está desarrollado para implementarse en un ambiente productivo.");
        }
    }
}
