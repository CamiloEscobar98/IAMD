<?php

namespace App\Http\ViewComposers\Client\Creators\Internal;

use Illuminate\View\View;

use App\Repositories\Admin\LinkageTypeRepository;
use App\Repositories\Admin\AssignmentContractRepository;
use App\Repositories\Admin\DocumentTypeRepository;

class CreatorInternalFilterComposer
{
    /** @var LinkageTypeRepository */
    protected $linkageTypeRepository;

    /** @var AssignmentContractRepository */
    protected $assignmentContractRepository;

    /** @var DocumentTypeRepository */
    protected $documentTypeRepository;

    public function __construct(
        LinkageTypeRepository $linkageTypeRepository,
        AssignmentContractRepository $assignmentContractRepository,
        DocumentTypeRepository $documentTypeRepository
    ) {
        $this->linkageTypeRepository = $linkageTypeRepository;
        $this->assignmentContractRepository = $assignmentContractRepository;
        $this->documentTypeRepository = $documentTypeRepository;
    }

    public function compose(View $view)
    {
        $linkageTypes = $this->linkageTypeRepository->all();
        $assignmentContracts = $this->assignmentContractRepository->all();
        $documentTypes = $this->documentTypeRepository->all();

        $view->with(compact('linkageTypes', 'assignmentContracts', 'documentTypes'));
    }
}
