<?php

namespace Database\Seeders\Client;

use Illuminate\Database\Seeder;

use App\Repositories\Client\StrategyRepository;

class StrategySeeder extends Seeder
{
    /** @var StrategyRepository */
    protected $strategyRepository;

    public function __construct(StrategyRepository $strategyRepository)
    {
        $this->strategyRepository = $strategyRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        print("¡¡ CREATING STRATEGIES !! \n \n");

        $randomNumber = rand(10, 50);

        $cont = 0;

        do {
            $current = $cont + 1;

            print("Creating Strategy: $current. \n");

            $priorityTool = $this->strategyRepository->createOneFactory();

            print("Strategy Created. Name: " . $priorityTool->name . "\n \n");

            $cont++;
            $randomNumber--;
        } while ($randomNumber > 0);

        print("STRATEGIES FINISHED. \n \n");
    }
}
