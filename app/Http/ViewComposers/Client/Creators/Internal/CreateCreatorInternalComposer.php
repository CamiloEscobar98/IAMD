<?php

namespace App\Http\ViewComposers\Client\Creators\Internal;

use Illuminate\View\View;

use App\Repositories\Admin\LinkageTypeRepository;
use App\Repositories\Admin\AssignmentContractRepository;
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

    /** @var StateRepository */
    protected $stateRepository;

    public function __construct(
        LinkageTypeRepository $linkageTypeRepository,
        AssignmentContractRepository $assignmentContractRepository,
        DocumentTypeRepository $documentTypeRepository,
        StateRepository $stateRepository,
    ) {
        $this->linkageTypeRepository = $linkageTypeRepository;
        $this->assignmentContractRepository = $assignmentContractRepository;
        $this->documentTypeRepository = $documentTypeRepository;
        $this->stateRepository = $stateRepository;
    }

    public function compose(View $view)
    {
        $linkageTypes = $this->linkageTypeRepository->all();
        $assignmentContracts = $this->assignmentContractRepository->all();
        $documentTypes = $this->documentTypeRepository->all();

        $states = $this->stateRepository->search([], ['country', 'cities'])->get();

        // dd($states->toArray());

        $view->with(compact('linkageTypes', 'assignmentContracts', 'documentTypes', 'states'));
    }
}
