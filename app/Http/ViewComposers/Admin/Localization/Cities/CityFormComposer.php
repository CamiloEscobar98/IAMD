<?php

namespace App\Http\ViewComposers\Admin\Localization\Cities;

use Illuminate\View\View;

use App\Repositories\Admin\CountryRepository;
use App\Services\Admin\CountryService;

class CityFormComposer
{
    /** @var CountryService */
    protected $countryService;

    /** @var CountryRepository */
    protected $countryRepository;

    public function __construct(
        CountryService $countryService,
        CountryRepository $countryRepository
    ) {
        $this->countryService = $countryService;
        $this->countryRepository = $countryRepository;
    }

    public function compose(View $view)
    {
        $cityId = request()->city;

        [$countries, $country, $states, $state, $cities, $city] = $this->countryService->getCountriesSelect($cityId);

        $view->with(compact('countries', 'country', 'states', 'state', 'cities', 'city'));
    }
}
