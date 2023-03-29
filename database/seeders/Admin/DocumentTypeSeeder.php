<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Seeder;

use App\Repositories\Admin\DocumentTypeRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class DocumentTypeSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var DocumentTypeRepository */
    protected $documentTypeRepository;

    public function __construct(DocumentTypeRepository $documentTypeRepository)
    {
        $this->documentTypeRepository = $documentTypeRepository;
        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $documentTypeArray = [
            [
                'name' => 'Tarjeta de Identidad',
                'slug' => 'T.I'
            ], [
                'name' => 'Cédula de Ciudadanía',
                'slug' => 'C.C'
            ],
        ];

        $this->command->getOutput()->progressStart(count($documentTypeArray));

        foreach ($documentTypeArray as $documentTypeItem) {
            $this->info("\n-Creando Tipo de Documentación: '{$documentTypeItem['name']}'\n");
            sleep(1);
            $this->documentTypeRepository->create($documentTypeItem);
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
