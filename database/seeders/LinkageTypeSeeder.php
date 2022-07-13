<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Repositories\LinkageTypeRepository;

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
        try {
            $this->linkageTypeRepository->create(['name' => 'Administrativo']);
            $this->linkageTypeRepository->create(['name' => 'Docente']);
            $this->linkageTypeRepository->create(['name' => 'Estudiante']);
        } catch (\Exception $th) {
            print($th->getMessage() . "\n");
        }
    }
}
