<?php

namespace Database\Seeders\Localization;

use App\Repositories\Admin\CityRepository;
use Illuminate\Database\Seeder;

use App\Services\Localization\ApiMarcoVegaColombiaStates;

use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\StateRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class StateAndCitySeeder extends Seeder
{
    use InteractsWithIO;

    /** @var StateRepository */
    protected $stateRepository;

    /** @var CountryRepository */
    protected $countryRepository;

    /** @var CityRepository */
    protected $cityRepository;

    /** @var ApiMarcoVegaColombiaStates */
    protected $apiMarcoVegaColombiaStates;

    public function __construct(
        StateRepository $stateRepository,
        CountryRepository $countryRepository,
        CityRepository $cityRepository,
        ApiMarcoVegaColombiaStates $apiMarcoVegaColombiaStates
    ) {
        $this->stateRepository = $stateRepository;
        $this->countryRepository = $countryRepository;
        $this->cityRepository = $cityRepository;
        $this->apiMarcoVegaColombiaStates = $apiMarcoVegaColombiaStates;
        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** Searching Colombia */

        $this->info('Buscando el País de Colombia dentro de la base de datos.');

        if ($colombia = $this->countryRepository->getByAttribute('name', 'Colombia')) {
            $this->info('Buscando Departamentos utilizando la API de MarcoVega.');
            /** Searching Departments */
            $states = $this->apiMarcoVegaColombiaStates->getDepartments();
            $this->info("Departamentos encontrados: {$states->count()}");
            $this->command->getOutput()->progressStart($states->count());

            $statesCollection = collect();

            foreach ($states as $stateItem) {
                $this->info("\n-Creando Departamento: '{$stateItem->departamento}'\n");
                sleep(1);
                /** @var \App\Models\Admin\Localization\State $state */
                $state = $this->stateRepository->create([
                    'country_id' => $colombia->id,
                    'name' => $stateItem->departamento,
                ]);
                $this->command->getOutput()->progressAdvance();

                $statesCollection->push(['id' => $state->id, 'name' => $state->name, 'cities' => $stateItem->ciudades]);
            }
            $this->command->getOutput()->progressFinish();

            foreach ($statesCollection as $stateCollectionItem) {
                sleep(1);
                $this->info("\nRegistrando los Municipios/Ciudades de: '{$stateCollectionItem['name']}'\n");
                $this->command->getOutput()->progressStart(count($stateCollectionItem['cities']));
                foreach ($stateCollectionItem['cities'] as $cityItem) {
                    /** @var \App\Models\Admin\Localization\City $city */
                    $city = $this->cityRepository->create([
                        'state_id' => $stateCollectionItem['id'],
                        'name' => $cityItem
                    ]);
                    $this->command->getOutput()->progressAdvance();
                }
                $this->command->getOutput()->progressFinish();
            }
        }
    }
}
