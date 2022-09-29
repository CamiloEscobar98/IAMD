<?php

namespace App\Http\ViewComposers\Client\Creators\External;

use Illuminate\View\View;

use App\Repositories\Admin\ExternalOrganizationRepository;
use App\Repositories\Admin\AssignmentContractRepository;
use App\Repositories\Admin\CityRepository;
use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\DocumentTypeRepository;
use App\Repositories\Admin\StateRepository;

class CreateCreatorExternalComposer
{
    /** @var ExternalOrganizationRepository */
    protected $externalOrganizationRepository;

    /** @var AssignmentContractRepository */
    protected $assignmentContractRepository;

    /** @var DocumentTypeRepository */
    protected $documentTypeRepository;

    /** @var CountryRepository */
    protected $countryRepository;

    /** @var CityRepository */
    protected $cityRepository;

    /** @var StateRepository */
    protected $stateRepository;

    public function __construct(
        ExternalOrganizationRepository $externalOrganizationRepository,
        AssignmentContractRepository $assignmentContractRepository,
        DocumentTypeRepository $documentTypeRepository,

        CountryRepository $countryRepository,
        StateRepository $stateRepository,
        CityRepository $cityRepository
    ) {
        $this->externalOrganizationRepository = $externalOrganizationRepository;
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


        $externalOrganizations = $this->externalOrganizationRepository->all();

        $assignmentContracts = $this->assignmentContractRepository->all()->where('is_internal', false);

        $documentTypes = $this->documentTypeRepository->all();


        $view->with(compact(
            'externalOrganizations',
            'assignmentContracts',
            'documentTypes',

            'countries',
            'states',
            'cities',

            'country',
            'state',
            'city'
        ));
    }
}
