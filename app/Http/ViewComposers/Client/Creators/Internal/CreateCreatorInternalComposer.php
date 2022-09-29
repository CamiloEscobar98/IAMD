<?php

namespace App\Http\ViewComposers\Client\Creators\Internal;

use Illuminate\View\View;

use App\Repositories\Admin\LinkageTypeRepository;
use App\Repositories\Admin\AssignmentContractRepository;
use App\Repositories\Admin\CityRepository;
use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\DocumentTypeRepository;
use App\Repositories\Admin\StateRepository;

class CreateCreatorInternalComposer
{
    /** @var LinkageTypeRepository */
    protected $linkageTypeRepository;

    /** @var AssignmentContractRepository */
    protected $assignmentContractRepository;

    /** @var DocumentTypeRepository */
    protected $documentTypeRepository;

    /** @var CountryRepository */
    protected $countryRepository;

    /** @var StateRepository */
    protected $stateRepository;

    /** @var CityRepository */
    protected $cityRepository;

    public function __construct(
        LinkageTypeRepository $linkageTypeRepository,
        AssignmentContractRepository $assignmentContractRepository,
        DocumentTypeRepository $documentTypeRepository,

        CountryRepository $countryRepository,
        StateRepository $stateRepository,
        CityRepository $cityRepository
    ) {
        $this->linkageTypeRepository = $linkageTypeRepository;
        $this->assignmentContractRepository = $assignmentContractRepository;
        $this->documentTypeRepository = $documentTypeRepository;

        $this->countryRepository = $countryRepository;
        $this->stateRepository = $stateRepository;
        $this->cityRepository = $cityRepository;
    }

    public function compose(View $view)
    {

        $countries = $this->countryRepository->all();

        $country = $countries->where('id', old('country_id', 11))->first();

        $states = $this->stateRepository->getByCountry($country);

        if ($states->count() > 0) {
            $state = old('state_id') ? $states->where('id', old('state_id'))->first() : $states->first();
            $cities = $this->cityRepository->getByState($state);
            $city = old('expedition_place_id') ? $cities->where('id', old('expedition_place_id'))->first() : $cities->first();
        } else {
            $states = [];
            $cities = [];
            $state = $this->stateRepository->newInstance();
            $city = $this->cityRepository->newInstance();
        }

        $linkageTypes = $this->linkageTypeRepository->all();

        $assignmentContracts = $this->assignmentContractRepository->all()->where('is_internal', true);

        $documentTypes = $this->documentTypeRepository->all();


        $view->with(compact(
            'linkageTypes',
            'assignmentContracts',
            'documentTypes',

            'countries',
            'states',
            'cities',

            'country',
            'state',
        ));
    }
}
