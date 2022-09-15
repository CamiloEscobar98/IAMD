<?php

namespace Database\Seeders\Client\Creator;

use Illuminate\Database\Seeder;

use App\Repositories\Client\CreatorRepository;

class CreatorSeeder extends Seeder
{
    /** @var CreatorRepository */
    protected $creatorRepository;

    public function __construct(CreatorRepository $creatorRepository)
    {
        $this->creatorRepository = $creatorRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $randomNumber = rand(100, 500);
        $cont = 0;

        print("¡¡ CREATING CREATORS !! \n \n");

        print("Random Number Creators for Create: $randomNumber. \n");

        do {
            $current = $cont + 1;
            print("Creating Creator: $current. \n");
            $creator = $this->creatorRepository->createOneFactory();
            print("Creator Created. Name: " . $creator->name .  "\n \n");

            $cont++;
            $randomNumber--;
        } while ($randomNumber > 0);

        print("¡¡ CREATORS CREATED !! \n \n");

        $this->call([
            CreatorDocumentSeeder::class,
            CreatorInternalOrExternalSeeder::class
        ]);
    }
}
