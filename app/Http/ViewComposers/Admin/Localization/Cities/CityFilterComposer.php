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
        
        $countryId = request()->get('country_id');

        if ($countryId) {
            /** @var \App\MOdels\Admin\Localization\Country $country */
            $country = $this->countryRepository->getById($countryId);
        } else {
            $country = $countries->where('name', 'Colombia')->first();
        }
        /** @var \App\MOdels\Admin\Localization\State $state */
        $states = $this->stateRepository->getByCountry($country);

        $state = $states->first();

        $view->with(compact('countries', 'states'));
    }
}
