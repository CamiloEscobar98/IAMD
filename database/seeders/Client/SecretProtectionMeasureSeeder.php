<?php

namespace Database\Seeders\Client;

use App\Repositories\Client\SecretProtectionMeasureRepository;
use Illuminate\Database\Seeder;

class SecretProtectionMeasureSeeder extends Seeder
{
    /** @var SecretProtectionMeasureRepository */
    protected $secretProtectionMeasureRepository;

    public function __construct(SecretProtectionMeasureRepository $secretProtectionMeasureRepository)
    {
        $this->secretProtectionMeasureRepository = $secretProtectionMeasureRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        print("¡¡ CREATING SECRET PROTECTION MEASURES !! \n \n");

        $randomNumber = rand(10, 50);

        $cont = 0;

        do {
            $current = $cont + 1;

            print("Creating Secret Protection Measure: $current. \n");

            $secretProtectionMeasure = $this->secretProtectionMeasureRepository->createOneFactory();

            print("Secret Protection Measure Created. Name: " . $secretProtectionMeasure->name . "\n \n");

            $cont++;
            $randomNumber--;
        } while ($randomNumber > 0);

        print("SECRET PROTECTION MEASURE FINISHED. \n \n");
    }
}
