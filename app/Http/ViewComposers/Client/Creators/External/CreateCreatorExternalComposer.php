<?php

namespace App\Http\ViewComposers\Client\Creators\External;

use Illuminate\View\View;

use App\Repositories\Admin\ExternalOrganizationRepository;
use App\Repositories\Admin\AssignmentContractRepository;
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

    /** @var StateRepository */
    protected $stateRepository;

    public function __construct(
        ExternalOrganizationRepository $externalOrganizationRepository,
        AssignmentContractRepository $assignmentContractRepository,
        DocumentTypeRepository $documentTypeRepository,
        StateRepository $stateRepository,
    ) {
        $this->externalOrganizationRepository = $externalOrganizationRepository;
        $this->assignmentContractRepository = $assignmentContractRepository;
        $this->documentTypeRepository = $documentTypeRepository;
        $this->stateRepository = $stateRepository;
    }

    public function compose(View $view)
    {
        $externalOrganizations = $this->externalOrganizationRepository->all();

        $assignmentContracts = $this->assignmentContractRepository->all()->where('is_internal', false);

        $documentTypes = $this->documentTypeRepository->all();

        $states = $this->stateRepository->search([], ['country', 'cities'])->get();

        $view->with(compact('externalOrganizations', 'assignmentContracts', 'documentTypes', 'states'));
    }
}
