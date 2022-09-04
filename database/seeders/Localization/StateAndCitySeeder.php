<?php

namespace Database\Seeders\Localization;

use App\Repositories\Admin\CityRepository;
use Illuminate\Database\Seeder;

use App\Services\Localization\ApiMarcoVegaColombiaStates;

use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\StateRepository;

class StateAndCitySeeder extends Seeder
{

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
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            /** Searching Colombia */
            print("Searching Colombia... \n");
            if ($colombia = $this->countryRepository->getByAttribute('name', 'Colombia')) {
                print("Searching Departments... \n");
                /** Searching Departments */
                $states = $this->apiMarcoVegaColombiaStates->getDepartments();
                print("States searched! Count: " . $states->count() . "\n");

                $states->each(function ($stateItem) use ($colombia) {
                    $state = $this->stateRepository->create([
                        'country_id' => $colombia->id,
                        'name' => $stateItem->departamento,
                    ]);
                    print("State created! Name: " . $state->name . "\n");

                    $cities = collect($stateItem->ciudades);
                    $cities->each(function ($cityItem) use ($state) {
                        $city = $this->cityRepository->create([
                            'state_id' => $state->id,
                            'name' => $cityItem
                        ]);
                        print("City created! Name: " . $city->name . "\n");
                    });
                });
            }
        } catch (\Exception $th) {
            print($th->getMessage() . "\n");
        }
    }
}
