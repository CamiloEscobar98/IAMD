<?php

namespace App\Http\ViewComposers\Admin\Localization\Cities;

use Illuminate\View\View;

use App\Repositories\Admin\CountryRepository;

class CityFilterComposer
{
    /** @var CountryRepository */
    protected $countryRepository;

    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    public function compose(View $view)
    {
        $countries = $this->countryRepository->search([], ['states'])->get();

        $view->with(compact('countries'));
    }
}
