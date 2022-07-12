<?php

namespace Database\Seeders;

use App\Repositories\DocumentTypeRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /** @var DocumentTypeRepository */
    protected $documentTypeRepository;

    public function __construct(DocumentTypeRepository $documentTypeRepository)
    {
        $this->documentTypeRepository = $documentTypeRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->documentTypeRepository->create([
            'name' => 'Tarjeta de Identidad',
            'slug' => 'T.I'
        ]);

        $this->documentTypeRepository->create([
            'name' => 'Cédula de Ciudadanía',
            'slug' => 'C.C'
        ]);
        $this->documentTypeRepository->create([
            'name' => 'Cédula de Extranjería',
            'slug' => 'C.E'
        ]);
    }
}
