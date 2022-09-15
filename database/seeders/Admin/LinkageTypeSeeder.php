<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Seeder;

use App\Repositories\Admin\LinkageTypeRepository;

class LinkageTypeSeeder extends Seeder
{
    /** @var LinkageTypeRepository */
    protected $linkageTypeRepository;

    public function __construct(LinkageTypeRepository $linkageTypeRepository)
    {
        $this->linkageTypeRepository = $linkageTypeRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        print("¡¡ CREATING LINKAGE TYPE !! \n \n");

        $names = ['Administrativo', 'Docente', 'Estudiante'];

        $cont = 0;

        foreach ($names as $value) {
            $current = $cont + 1;

            print("Creating Linkage Type: $current. \n");

            $linkageType = $this->linkageTypeRepository->create(['name' => $value]);

            print("Linkage Type Created. Name: " . $linkageType->name .  "\n \n");

            $cont++;
        }

        print("¡¡ ASSIGNMENT CONTRACTS CREATED !! \n \n");
    }
}
