<?php

namespace Database\Seeders\Client\Creator;

use Illuminate\Database\Seeder;

use App\Repositories\Admin\CityRepository;
use App\Repositories\Admin\DocumentTypeRepository;
use App\Repositories\Client\CreatorDocumentRepository;
use App\Repositories\Client\CreatorRepository;

class CreatorDocumentSeeder extends Seeder
{
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
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = $this->cityRepository->all();
        $documentTypes = $this->documentTypeRepository->all()->whereNotIn('slug', ['T.I']);

        print("¡¡ CREATING DOCUMENT FOR CREATORS !! \n \n");

        $this->creatorRepository->all()->each(function ($creator) use ($cities, $documentTypes) {
            $city = $cities->random(1)->first();
            $documentType = $documentTypes->random(1)->first();

            print("Creating Document for Creator: " . $creator->name . "\n");

            $document = $this->creatorDocumentRepository->createOneFactory([
                'creator_id' => $creator->id,
                'document_type_id' => $documentType->id,
                'expedition_place_id' => $city->id
            ]);
            print("Document Created. Number: " . $document->document . "\n \n");
        });

        print("¡¡ DOCUMENTS FOR CREATORS CREATED !! \n \n");
    }
}
