<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Client\IntangibleAssetConfidentialityContractRepository;
use App\Repositories\Client\IntangibleAssetRepository;
use App\Services\FileSystem\IntangibleAsset\FileConfidencialityContractService;
use Illuminate\Support\Facades\Storage;

class IntangibleAssetFileController extends Controller
{
    /** @var FileConfidencialityContractService */
    protected $fileConfidencialityContractService;

    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    /** @var IntangibleAssetConfidentialityContractRepository */
    protected $intangibleAssetConfidentialityContractRepository;

    public function __construct(
        FileConfidencialityContractService $fileConfidencialityContractService,

        IntangibleAssetRepository $intangibleAssetRepository,
        IntangibleAssetConfidentialityContractRepository $intangibleAssetConfidentialityContractRepository
    ) {
        $this->fileConfidencialityContractService = $fileConfidencialityContractService;

        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->intangibleAssetConfidentialityContractRepository = $intangibleAssetConfidentialityContractRepository;
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
}
