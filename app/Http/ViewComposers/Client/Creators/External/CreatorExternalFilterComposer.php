<?php

namespace App\Http\ViewComposers\Client\Creators\External;

use Illuminate\View\View;

use App\Repositories\Admin\ExternalOrganizationRepository;
use App\Repositories\Admin\AssignmentContractRepository;
use App\Repositories\Admin\DocumentTypeRepository;

class CreatorExternalFilterComposer
{
    /** @var ExternalOrganizationRepository */
    protected $externalOrganizationRepository;

    /** @var AssignmentContractRepository */
    protected $assignmentContractRepository;

    /** @var DocumentTypeRepository */
    protected $documentTypeRepository;

    public function __construct(
        ExternalOrganizationRepository $externalOrganizationRepository,
        AssignmentContractRepository $assignmentContractRepository,
        DocumentTypeRepository $documentTypeRepository
    ) {
        $this->externalOrganizationRepository = $externalOrganizationRepository;
        $this->assignmentContractRepository = $assignmentContractRepository;
        $this->documentTypeRepository = $documentTypeRepository;
    }

    public function compose(View $view)
    {
        $externalOrganizations = $this->externalOrganizationRepository->all();
     
        $assignmentContracts = $this->assignmentContractRepository->all()->where('is_internal', false);
     
        $documentTypes = $this->documentTypeRepository->all();

        $view->with(compact('externalOrganizations', 'assignmentContracts', 'documentTypes'));
    }
}
