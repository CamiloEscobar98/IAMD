<?php

namespace Database\Seeders\Client\Creator;

use Illuminate\Database\Seeder;

use App\Repositories\Admin\CityRepository;
use App\Repositories\Admin\DocumentTypeRepository;
use App\Repositories\Client\CreatorDocumentRepository;
use App\Repositories\Client\CreatorRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class CreatorDocumentSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var CreatorRepository */
    protected $creatorRepository;

    /** @var CreatorDocumentRepository */
    protected $creatorDocumentRepository;

    /** @var DocumentTypeRepository */
    protected $documentTypeRepository;

    /** @var CityRepository */
    protected $cityRepository;

    public function __construct(
        CreatorRepository $creatorRepository,
        CreatorDocumentRepository $creatorDocumentRepository,
        DocumentTypeRepository $documentTypeRepository,
        CityRepository $cityRepository
    ) {
        $this->creatorRepository = $creatorRepository;
        $this->creatorDocumentRepository = $creatorDocumentRepository;
        $this->documentTypeRepository = $documentTypeRepository;
        $this->cityRepository = $cityRepository;
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
            $cities = $this->cityRepository->all();
            $documentTypes = $this->documentTypeRepository->all()->whereNotIn('slug', ['T.I']);
            $creators = $this->creatorRepository->all();
            $this->command->getOutput()->progressStart($creators->count());

            foreach ($creators as $creator) {
                sleep(1);
                /** @var \App\Models\Client\Creator\Creator $creator */
                $this->info("\n-Creando documento para el Creador: '{$creator->name}'\n");

                /** @var \App\Models\Admin\Localization\City $cityRandom */
                $cityRandom = $cities->random(1)->first();
                /** @var \App\Models\Admin\DocumentType $documentTypeRandom */
                $documentTypeRandom = $documentTypes->random(1)->first();

                $this->creatorDocumentRepository->createOneFactory([
                    'creator_id' => $creator->id,
                    'document_type_id' => $documentTypeRandom->id,
                    'expedition_place_id' => $cityRandom->id
                ]);
                $this->command->getOutput()->progressAdvance();
            }
            $this->command->getOutput()->progressFinish();
        } else {
            $this->warn("Este Seeder no está desarrollado para implementarse en un ambiente productivo.");
        }
    }
}
