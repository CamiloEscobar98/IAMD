<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use App\Services\FileSystem\IntangibleAsset\FileConfidencialityContractService;
use App\Services\FileSystem\IntangibleAsset\FileSessionRightContractService;

use App\Repositories\Client\IntangibleAssetConfidentialityContractRepository;
use App\Repositories\Client\IntangibleAssetRepository;
use App\Repositories\Client\IntangibleAssetSessionRightContractRepository;

class IntangibleAssetFileController extends Controller
{
    /** @var FileConfidencialityContractService */
    protected $fileConfidencialityContractService;

    /**  @var FileSessionRightContractService */
    protected $fileSessionRightContractService;

    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    /** @var IntangibleAssetConfidentialityContractRepository */
    protected $intangibleAssetConfidentialityContractRepository;

    /** @var IntangibleAssetSessionRightContractRepository */
    protected $intangibleAssetSessionRightContractRepository;

    public function __construct(
        FileConfidencialityContractService $fileConfidencialityContractService,
        FileSessionRightContractService $fileSessionRightContractService,

        IntangibleAssetRepository $intangibleAssetRepository,
        IntangibleAssetConfidentialityContractRepository $intangibleAssetConfidentialityContractRepository,
        IntangibleAssetSessionRightContractRepository $intangibleAssetSessionRightContractRepository,
    ) {
        $this->middleware('auth');

        $this->fileConfidencialityContractService = $fileConfidencialityContractService;
        $this->fileSessionRightContractService = $fileSessionRightContractService;

        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->intangibleAssetConfidentialityContractRepository = $intangibleAssetConfidentialityContractRepository;
        $this->intangibleAssetSessionRightContractRepository = $intangibleAssetSessionRightContractRepository;
    }

    /**
     * Download current Confidenciality Contract of Intangible Asset.
     * 
     * @param int $id
     * @param int $intangibleAsset
     */
    public function downloadConfidencialityContract($id, $intangibleAsset)
    {
        try {
            /** @var \App\Models\Client\IntangibleAsset\IntangibleAsset */
            $item = $this->intangibleAssetConfidentialityContractRepository->getById($intangibleAsset);

            $filePath = $this->fileConfidencialityContractService->getConfidencialityContractFilePath($item->full_path);

            return response()->download($filePath);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Download current Session Right Contract of Intangible Asset.
     * 
     * @param int $id
     * @param int $intangibleAsset
     */
    public function downloadSessionRightContract($id, $intangibleAsset)
    {
        try {
            /** @var \App\Models\Client\IntangibleAsset\IntangibleAsset */
            $item = $this->intangibleAssetSessionRightContractRepository->getById($intangibleAsset);

            $filePath = $this->fileSessionRightContractService->getSessionRightContractFilePath($item->full_path);

            return response()->download($filePath);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
