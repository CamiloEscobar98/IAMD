<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Seeder;

use App\Repositories\Admin\LinkageTypeRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class LinkageTypeSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var LinkageTypeRepository */
    protected $linkageTypeRepository;

    public function __construct(LinkageTypeRepository $linkageTypeRepository)
    {
        $this->linkageTypeRepository = $linkageTypeRepository;
        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $linkageTypes = ['Administrativo', 'Docente', 'Estudiante'];

        $this->command->getOutput()->progressStart(count($linkageTypes));

        foreach ($linkageTypes as $name) {
            $this->info("\n-Creando Tipo de Vinculación para Creadores: '{$name}'\n");
            sleep(1);
            $this->linkageTypeRepository->create(compact('name'));
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
