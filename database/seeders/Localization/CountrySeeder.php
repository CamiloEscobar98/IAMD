<?php

namespace Database\Seeders\Localization;

use Illuminate\Database\Seeder;

use App\Repositories\CountryRepository;

class CountrySeeder extends Seeder
{
    /** @var CountryRepository */
    protected $countryRepository;

    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->countryRepository->createFactory(10);

        if (!$hasColombia = $this->countryRepository->getByAttribute('name', 'Colombia')) {
            $this->countryRepository->create(['name' => 'Colombia']);
        }
    }
}
