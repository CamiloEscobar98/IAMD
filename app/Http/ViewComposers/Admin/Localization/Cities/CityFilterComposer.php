<?php

namespace App\Http\ViewComposers\Admin\Localization\Cities;

use Illuminate\View\View;

use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\StateRepository;
use App\Repositories\Admin\CityRepository;

class CityFilterComposer
{
    /** @var CountryRepository */
    protected $countryRepository;

    /** @var StateRepository  */
    protected $stateRepository;

    /** @var CityRepository */
    protected $cityRepository;

    public function __construct(
        CountryRepository $countryRepository,
        StateRepository $stateRepository,
        CityRepository $cityRepository
    ) {
        $this->countryRepository = $countryRepository;
        $this->stateRepository = $stateRepository;
        $this->cityRepository = $cityRepository;
    }

    public function compose(View $view)
    {
        $countries = $this->countryRepository->all();
        $states = collect();

        $countryId = request('country_id');

        if ($countryId) {
            /** @var \App\MOdels\Admin\Localization\Country $country */
            $country = $this->countryRepository->getById($countryId);
            $states = $this->stateRepository->getByCountry($country);
        }

        $countries = $countries->pluck('name', 'id')->prepend('---Seleccionar país');
        $states = $states->pluck('name', 'id')->prepend('---Seleccionar Departamento');

        $view->with(compact('countries', 'states'));
    }
}
