<?php

namespace Database\Seeders\Client;

use App\Repositories\Client\PriorityToolRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriorityToolSeeder extends Seeder
{
    /** @var PriorityToolRepository */
    protected $priorityToolRepository;

    public function __construct(PriorityToolRepository $priorityToolRepository)
    {
        $this->priorityToolRepository = $priorityToolRepository;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        print("¡¡ CREATING PRIORITY TOOLS !! \n \n");

        $randomNumber = rand(10, 20);

        $cont = 0;

        do {
            $current = $cont + 1;

            print("Creating Priority Tool: $current. \n");

            $priorityTool = $this->priorityToolRepository->createOneFactory();

            print("Priority Tool Created. Name: " . $priorityTool->name . "\n \n");

            $cont++;
            $randomNumber--;
        } while ($randomNumber > 0);

        print("PRIORITY TOOLS FINISHED. \n \n");
    }
}
