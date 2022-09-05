<?php

namespace App\Http\ViewComposers\Admin\Localization\States;

use Illuminate\View\View;

use App\Repositories\Admin\CountryRepository;

class StateFilterComposer
{
    /** @var CountryRepository */
    protected $countryRepository;

    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    public function compose(View $view)
    {
        $countries = $this->countryRepository->all();

        $view->with(compact('countries'));
    }
}
