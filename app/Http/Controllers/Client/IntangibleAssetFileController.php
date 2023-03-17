<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Client\IntangibleAssetAcademicRecordRepository;
use App\Services\FileSystem\IntangibleAssets\FileConfidencialityContractService;
use App\Services\FileSystem\IntangibleAssets\FileSessionRightContractService;

use App\Repositories\Client\IntangibleAssetConfidentialityContractRepository;
use App\Repositories\Client\IntangibleAssetRepository;
use App\Repositories\Client\IntangibleAssetSessionRightContractRepository;
use App\Services\FileSystem\IntangibleAssets\FileAcademicRecordService;
use Exception;
use Illuminate\Support\Facades\Log;

class IntangibleAssetFileController extends Controller
{
    /** @var FileConfidencialityContractService */
    protected $fileConfidencialityContractService;

    /**  @var FileSessionRightContractService */
    protected $fileSessionRightContractService;

    /** @var FileAcademicRecordService */
    protected $fileAcademicRecordService;

    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    /** @var IntangibleAssetConfidentialityContractRepository */
    protected $intangibleAssetConfidentialityContractRepository;

    /** @var IntangibleAssetSessionRightContractRepository */
    protected $intangibleAssetSessionRightContractRepository;

    /** @var IntangibleAssetAcademicRecordRepository */
    protected $intangibleAssetAcademicRecordRepository;

    public function __construct(
        FileConfidencialityContractService $fileConfidencialityContractService,
        FileSessionRightContractService $fileSessionRightContractService,
        FileAcademicRecordService $fileAcademicRecordService,

        IntangibleAssetRepository $intangibleAssetRepository,
        IntangibleAssetConfidentialityContractRepository $intangibleAssetConfidentialityContractRepository,
        IntangibleAssetSessionRightContractRepository $intangibleAssetSessionRightContractRepository,
        IntangibleAssetAcademicRecordRepository $intangibleAssetAcademicRecordRepository
    ) {
        $this->middleware('auth');

        $this->fileConfidencialityContractService = $fileConfidencialityContractService;
        $this->fileSessionRightContractService = $fileSessionRightContractService;
        $this->fileAcademicRecordService = $fileAcademicRecordService;

        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->intangibleAssetConfidentialityContractRepository = $intangibleAssetConfidentialityContractRepository;
        $this->intangibleAssetSessionRightContractRepository = $intangibleAssetSessionRightContractRepository;
        $this->intangibleAssetAcademicRecordRepository = $intangibleAssetAcademicRecordRepository;
    }

    /**
     * Download current Confidenciality Contract of Intangible Asset.
     * 
     * @param int $client
     * @param int $intangible_asset
     */
    public function downloadConfidencialityContract($client, $intangible_asset)
    {
        try {
            /** @var \App\Models\Client\IntangibleAsset\IntangibleAssetConfidentialityContract */
            $item = $this->intangibleAssetConfidentialityContractRepository->getById($intangible_asset);

            $filePath = $this->fileConfidencialityContractService->getConfidencialityContractFilePath($item->full_path);

            return response()->download($filePath);
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/IntangibleAssetFileController:DownloadConfidencialityContract/Exception: {$e->getMessage()}");
        }
    }

    /**
     * Download current Session Right Contract of Intangible Asset.
     * 
     * @param int $client
     * @param int $intangible_asset
     */
    public function downloadSessionRightContract($client, $intangible_asset)
    {
        try {
            /** @var \App\Models\Client\IntangibleAsset\IntangibleAssetSessionRightContract */
            $item = $this->intangibleAssetSessionRightContractRepository->getById($intangible_asset);

            $filePath = $this->fileSessionRightContractService->getSessionRightContractFilePath($item->full_path);

            return response()->download($filePath);
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/IntangibleAssetFileController:DownloadSessionRightContract/Exception: {$e->getMessage()}");
        }
    }

    /**
     * Download current Academic Record of Intangible Asset.
     * 
     * @param int $client
     * @param int $intangible_asset
     */
    public function downloadAcademicRecord($client, $intangible_asset)
    {
        try {
            /** @var \App\Models\Client\IntangibleAsset\IntangibleAssetAcademicRecord */
            $item = $this->intangibleAssetAcademicRecordRepository->getById($intangible_asset);

            $filePath = $this->fileAcademicRecordService->getAcademicRecordFile($item->full_path);

            return response()->download($filePath);
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/IntangibleAssetFileController:DownloadAcademicRecord/Exception: {$e->getMessage()}");
        }
    }
}
