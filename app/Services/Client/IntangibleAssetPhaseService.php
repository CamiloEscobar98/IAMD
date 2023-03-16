<?php

namespace App\Services\Client;

use App\Repositories\Client\IntangibleAssetAcademicRecordRepository;
use Illuminate\Support\Facades\DB;

use App\Repositories\Client\IntangibleAssetRepository;
use App\Repositories\Client\IntangibleAssetCommercialRepository;
use App\Repositories\Client\IntangibleAssetPublishedRepository;
use App\Repositories\Client\IntangibleAssetContabilityRepository;
use App\Repositories\Client\IntangibleAssetConfidentialityContractRepository;
use App\Repositories\Client\IntangibleAssetProtectionActionRepository;

use App\Repositories\Client\IntangibleAssetDPIRepository;
use App\Repositories\Client\IntangibleAssetCreatorRepository;
use App\Repositories\Client\IntangibleAssetCommentRepository;
use App\Repositories\Client\IntangibleAssetDpiPriorityToolRepository;
use App\Repositories\Client\IntangibleAssetPhaseRepository;
use App\Repositories\Client\IntangibleAssetSecretProtectionMeasureRepository;
use App\Repositories\Client\IntangibleAssetSessionRightContractRepository;
use App\Services\FileSystem\IntangibleAssets\FileAcademicRecordService;
use App\Services\FileSystem\IntangibleAssets\FileConfidencialityContractService;
use App\Services\FileSystem\IntangibleAssets\FileSessionRightContractService;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IntangibleAssetPhaseService
{
    /** Single Data */

    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    /** @var IntangibleAssetCommercialRepository */
    protected $intangibleAssetCommercialRepository;

    /** @var IntangibleAssetPublishedRepository */
    protected $intangibleAssetPublishedRepository;

    /** @var IntangibleAssetContabilityRepository */
    protected $intangibleAssetContabilityRepository;

    /** @var IntangibleAssetProtectionActionRepository */
    protected $intangibleAssetProtectionActionRepository;

    /** @var IntangibleAssetConfidentialityContractRepository */
    protected $intangibleAssetConfidentialityContractRepository;

    /** @var IntangibleAssetSessionRightContractRepository */
    protected $intangibleAssetSessionRightContractRepository;

    /** @var IntangibleAssetAcademicRecordRepository */
    protected $intangibleAssetAcademicRecordRepository;

    /** @var IntangibleAssetPhaseRepository */
    protected $intangibleAssetPhaseRepository;

    /** Multiple Data */

    /** @var IntangibleAssetDPIRepository */
    protected $intangibleAssetDPIRepository;

    /** @var IntangibleAssetCreatorRepository */
    protected $intangibleAssetCreatorRepository;

    /** @var IntangibleAssetCommentRepository */
    protected $intangibleAssetCommentRepository;

    /** @var IntangibleAssetSecretProtectionMeasureRepository */
    protected $intangibleAssetSecretProtectionMeasureRepository;

    /** @var IntangibleAssetDpiPriorityToolRepository */
    protected $intangibleAssetDpiPriorityToolRepository;

    /** File Data */

    /** @var FileConfidencialityContractService */
    protected $fileConfidencialityContractService;

    /** @var FileSessionRightContractService */
    protected $fileSessionRightContractService;

    /** @var FileAcademicRecordService */
    protected $fileAcademicRecordService;

    public function __construct(
        IntangibleAssetRepository $intangibleAssetRepository,
        IntangibleAssetCommercialRepository $intangibleAssetCommercialRepository,
        IntangibleAssetPublishedRepository $intangibleAssetPublishedRepository,
        IntangibleAssetConfidentialityContractRepository $intangibleAssetConfidentialityContractRepository,
        IntangibleAssetSessionRightContractRepository $intangibleAssetSessionRightContractRepository,
        IntangibleAssetAcademicRecordRepository $intangibleAssetAcademicRecordRepository,
        IntangibleAssetContabilityRepository $intangibleAssetContabilityRepository,
        IntangibleAssetProtectionActionRepository $intangibleAssetProtectionActionRepository,
        IntangibleAssetPhaseRepository $intangibleAssetPhaseRepository,

        IntangibleAssetDPIRepository $intangibleAssetDPIRepository,
        IntangibleAssetCreatorRepository $intangibleAssetCreatorRepository,
        IntangibleAssetCommentRepository $intangibleAssetCommentRepository,
        IntangibleAssetSecretProtectionMeasureRepository $intangibleAssetSecretProtectionMeasureRepository,
        IntangibleAssetDpiPriorityToolRepository $intangibleAssetDpiPriorityToolRepository,

        FileConfidencialityContractService $fileConfidencialityContractService,
        FileSessionRightContractService $fileSessionRightContractService,
        FileAcademicRecordService $fileAcademicRecordService
    ) {
        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->intangibleAssetCommercialRepository = $intangibleAssetCommercialRepository;
        $this->intangibleAssetPublishedRepository = $intangibleAssetPublishedRepository;
        $this->intangibleAssetConfidentialityContractRepository = $intangibleAssetConfidentialityContractRepository;
        $this->intangibleAssetSessionRightContractRepository = $intangibleAssetSessionRightContractRepository;
        $this->intangibleAssetAcademicRecordRepository = $intangibleAssetAcademicRecordRepository;
        $this->intangibleAssetContabilityRepository = $intangibleAssetContabilityRepository;
        $this->intangibleAssetProtectionActionRepository = $intangibleAssetProtectionActionRepository;
        $this->intangibleAssetDpiPriorityToolRepository = $intangibleAssetDpiPriorityToolRepository;
        $this->intangibleAssetPhaseRepository = $intangibleAssetPhaseRepository;

        $this->intangibleAssetDPIRepository = $intangibleAssetDPIRepository;
        $this->intangibleAssetCreatorRepository = $intangibleAssetCreatorRepository;
        $this->intangibleAssetCommentRepository = $intangibleAssetCommentRepository;
        $this->intangibleAssetSecretProtectionMeasureRepository = $intangibleAssetSecretProtectionMeasureRepository;

        $this->fileConfidencialityContractService = $fileConfidencialityContractService;
        $this->fileSessionRightContractService = $fileSessionRightContractService;
        $this->fileAcademicRecordService = $fileAcademicRecordService;
    }

    /**
     * Intangible Asset Phase One: Intangible Asset Classification
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param array $data
     * 
     * @return string
     */
    public function updatePhaseOne($intangibleAsset, $data): string
    {
        $message = __('pages.client.intangible_assets.phases.one.messages.save_error');
        try {
            DB::beginTransaction();

            $this->intangibleAssetRepository->update($intangibleAsset, ['classification_id'  => $data['intellectual_property_right_product_id']]);
            $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'one');

            DB::commit();

            $message = __('pages.client.intangible_assets.phases.one.messages.save_success');
        } catch (QueryException $qe) {
            DB::rollBack();
            Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseOne/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseOne/Exception: {$e->getMessage()}");
        }
        return $message;
    }

    /**
     * Intangible Asset Phase Two: Intangible Asset Description
     * 
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param array $data
     * 
     * @return string
     */
    public function updatePhaseTwo($intangibleAsset, $data): string
    {
        $message = __('pages.client.intangible_assets.phases.two.messages.save_error');
        try {
            DB::beginTransaction();

            $this->intangibleAssetRepository->update($intangibleAsset, $data);
            $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'two');

            DB::commit();

            $message = __('pages.client.intangible_assets.phases.two.messages.save_success');
        } catch (QueryException $qe) {
            DB::rollBack();
            Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseTwo/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseTwo/Exception: {$e->getMessage()}");
        }
        return $message;
    }

    /**
     * Intangible Asset Phase Three: Intangible Asset State
     * 
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param array $data
     * 
     * @return string
     */
    public function updatePhaseThree($intangibleAsset, $data): string
    {
        $message = __('pages.client.intangible_assets.phases.three.messages.save_error');
        try {
            DB::beginTransaction();

            $this->intangibleAssetRepository->update($intangibleAsset, $data);
            $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'three');
            DB::commit();

            $message = __('pages.client.intangible_assets.phases.three.messages.save_success');
        } catch (QueryException $qe) {
            DB::rollBack();
            Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseThree/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseThree/Exception: {$e->getMessage()}");
        }
        return $message;
    }

    /**
     * Intangible Asset Phase Four: Intangible Asset DPIS
     * 
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param array $dpis
     * 
     * @return string
     */
    public function updatePhaseFour($intangibleAsset, $dpis): string
    {
        $message = __('pages.client.intangible_assets.phases.four.messages.save_error');
        try {
            DB::beginTransaction();

            $intangibleAsset->dpis()->delete();

            foreach ($dpis as $dpi) {
                $this->intangibleAssetDPIRepository->create([
                    'intangible_asset_id' => $intangibleAsset->id,
                    'dpi_id' => $dpi
                ]);
            }
            $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'four');
            DB::commit();

            $message = __('pages.client.intangible_assets.phases.four.messages.save_success');
        } catch (QueryException $qe) {
            DB::rollBack();
            Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFour/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFour/Exception: {$e->getMessage()}");
        }
        return $message;
    }

    /**
     * Intangible Asset Phase Four: Intangible Asset current State
     * 
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param array $data
     * @param string $subPhase
     * 
     * @return string
     */
    public function updatePhaseFive($intangibleAsset, array $data, string $subPhase): string
    {

        switch ($subPhase) {
            case '1': # Intangible Asset has been published.
                $message = $this->updateIntangibleAssetPublished($intangibleAsset, $data);
                break;

            case '2':
                $message = $this->updateIntangibleAssetConfidencialityContract($intangibleAsset, $data);
                break;

            case '3':
                $message = $this->updateIntangibleAssetCreators($intangibleAsset, $data);
                break;

            case '4':
                $message = $this->updateIntangibleAssetSessionRightContract($intangibleAsset, $data);
                break;

            case '5':
                $message = $this->updateIntangibleAssetContability($intangibleAsset, $data);
                break;

            case '6':
                $message = $this->updateIntangibleAssetAcademicRecord($intangibleAsset, $data);
                break;
        }

        $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'five');

        return $message;
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param array $data
     * @param string $type
     * 
     * @return string
     */
    public function updatePhaseSix($intangibleAsset, $data, $type): string
    {
        try {

            DB::beginTransaction();

            $message = __('pages.client.intangible_assets.phases.six.messages.save_error');

            switch ($type) {
                case '1':
                    $this->intangibleAssetCommentRepository->create($data);
                    break;

                case '2':
                    # code...
                    break;
            }

            $message = __('pages.client.intangible_assets.phases.six.messages.save_success');

            $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'six');
            DB::commit();

            return $message;
        } catch (\Exception $th) {
            return __('pages.client.intangible_assets.phases.six.messages.save_error');
        }
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param array $data
     * @param string $subPhase
     * 
     * @return string
     */
    public function updatePhaseSeven($intangibleAsset, $data, $subPhase): string
    {
        try {

            DB::beginTransaction();

            $message = __('pages.client.intangible_assets.phases.seven.messages.save_error');

            switch ($subPhase) {
                case '1':
                    $message = $this->updateIntangibleAssetProtectionAction($intangibleAsset, $data);
                    break;

                case '2':
                    $message = $this->updateIntangibleAssetSecretProtectionMeasures($intangibleAsset, $data);
                    break;
            }

            $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'seven');
            DB::commit();

            return $message;
        } catch (\Exception $th) {
            DB::rollBack();
            return __('pages.client.intangible_assets.phases.seven.messages.save_error');
        }
    }

    /**
     * @param int $intangibleAsset
     * @param Request $request
     * 
     * @return string
     */
    public function updatePhaseEight($intangibleAsset, $request) # : string
    {
        $message = __('pages.client.intangible_assets.phases.eight.sub_phases.has_tool.messages.save_success');

        /** @var \App\Models\Client\IntangibleAsset\IntangibleAsset */
        $intangibleAsset = $this->intangibleAssetRepository->getByIdWithRelations($intangibleAsset, ['dpis', 'priority_tools']);

        $hasPriorityTool = $request->get('has_priority_tools');


        if ($hasPriorityTool == -1) {
            try {
                DB::beginTransaction();

                $intangibleAsset->priority_tools()->delete();

                $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'eight');
                DB::commit();

                return __('pages.client.intangible_assets.phases.eight.sub_phases.has_tool.messages.save_success');
            } catch (\Exception $th) {
                DB::rollBack();
                return __('pages.client.intangible_assets.phases.eight.sub_phases.has_tool.messages.save_error');
            }
        } else {
            try {

                DB::beginTransaction();

                $intangibleAsset->priority_tools()->delete();

                /** @var Collection */
                $dpis = $intangibleAsset->dpis;

                $dpis->each(function ($dpi) use ($request, $intangibleAsset) {
                    $dpiId = $dpi->dpi_id;

                    $toolDpiRequest = $request->get("tool_id_{$dpiId}");

                    if (!is_null($toolDpiRequest)) {
                        $intangibleAsset->priority_tools()->where('dpi_id', $dpiId)->delete();

                        foreach ($toolDpiRequest as $tool) {
                            $this->intangibleAssetDpiPriorityToolRepository->create([
                                'intangible_asset_id' => $intangibleAsset->id,
                                'priority_tool_id' => $tool,
                                'dpi_id' => $dpiId
                            ]);
                        }
                    }
                });
                $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'eight');
                DB::commit();

                return $message;
            } catch (\Exception $th) {
                DB::rollBack();

                dd($th->getMessage());

                return __('pages.client.intangible_assets.phases.eight.sub_phases.has_tool.messages.save_error');
            }
        }
    }

    /**
     * Intangible Asset Phase Three: Intangible Asset State
     * 
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param array $data
     * 
     * @return string
     */
    public function updatePhaseNine($intangibleAsset, $data): string
    {
        $message = __('pages.client.intangible_assets.phases.nine.sub_phases.is_commercial.messages.save_success');

        if ($data['is_commercial'] == -1) {
            try {
                DB::beginTransaction();

                $intangibleAsset->intangible_asset_commercial()->delete();

                $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'nine');
                DB::commit();

                return $message;
            } catch (\Exception $th) {
                DB::rollBack();
                return __('pages.client.intangible_assets.phases.nine.sub_phases.is_commercial.messages.save_error');
            }
        } else {
            try {
                DB::beginTransaction();

                $this->intangibleAssetCommercialRepository->updateOrCreate([
                    'intangible_asset_id' => $intangibleAsset->id
                ], $data);

                $this->intangibleAssetPhaseRepository->updatePhase($intangibleAsset->id, 'nine');
                DB::commit();

                return $message;
            } catch (\Exception $th) {
                DB::rollBack();
                return __('pages.client.intangible_assets.phases.nine.sub_phases.is_commercial.messages.save_error');
            }
        }
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param array $data
     * 
     * @return string
     */
    private function updateIntangibleAssetPublished($intangibleAsset, $data): string
    {
        $message = __('pages.client.intangible_assets.phases.five.sub_phases.is_published.messages.save_error');

        if ($data['is_published'] == -1) {
            try {
                DB::beginTransaction();
                $intangibleAsset->intangible_asset_published()->delete();
                DB::commit();
                $message = __('pages.client.intangible_assets.phases.five.sub_phases.is_published.messages.save_success');
            } catch (QueryException $qe) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetPublished/Unselected/QueryException: {$qe->getMessage()}");
            } catch (Exception $e) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetPublished/Unselected/Exception: {$e->getMessage()}");
            }
        } else {
            try {
                DB::beginTransaction();
                $data['intangible_asset_id'] = $intangibleAsset->id;
                $this->intangibleAssetPublishedRepository->updateOrCreate([
                    'intangible_asset_id' => $intangibleAsset->id
                ], $data);
                DB::commit();
                $message = __('pages.client.intangible_assets.phases.five.sub_phases.is_published.messages.save_success');
            } catch (QueryException $qe) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetPublished/Selected/QueryException: {$qe->getMessage()}");
            } catch (Exception $e) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetPublished/Selected/Exception: {$e->getMessage()}");
            }
        }

        return $message;
    }


    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param array $data
     * 
     * @return string        $this->intangibleAssetConfidentialityContractRepository = $intangibleAssetConfidentialityContractRepository;

     * @param array $data
     * @param \Illuminate\Http\UploadedFile $file
     * 
     * @return string
     */
    private function updateIntangibleAssetConfidencialityContract($intangibleAsset, $data): string
    {
        $message = __('pages.client.intangible_assets.phases.five.sub_phases.confidenciality_contract.messages.save_error');

        if ($data['has_confidenciality_contract'] == -1) {
            try {
                DB::beginTransaction();
                $this->fileConfidencialityContractService->deleteConfidencialityContractFile($intangibleAsset);
                $intangibleAsset->intangible_asset_confidenciality_contract()->delete();
                DB::commit();
                $message = __('pages.client.intangible_assets.phases.five.sub_phases.confidenciality_contract.messages.save_success');
            } catch (QueryException $qe) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetConfidencialityContract/Unselected/QueryException: {$qe->getMessage()}");
            } catch (Exception $e) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetConfidencialityContract/Unselected/Exception: {$e->getMessage()}");
            }
        } else {
            $newData = [];
            try {
                /** Store the File */
                $this->fileConfidencialityContractService->deleteConfidencialityContractFile($intangibleAsset);

                /** @var \Illuminate\Http\UploadedFile $file */
                $file = $data['file'];
                $filePath = '';
                $fileName = time() . ".{$file->getClientOriginalExtension()}";

                $fullPath = $filePath . $fileName;

                $this->fileConfidencialityContractService->storeConfidencialityContractFile($fullPath, $file);

                $newData['intangible_asset_id'] = $intangibleAsset->id;
                $newData['file'] = $fileName;
                $newData['file_path'] = $filePath;
                $newData['organization_confidenciality'] = $data['organization_confidenciality'];

                /** ./Store the File */

                DB::beginTransaction();
                $this->intangibleAssetConfidentialityContractRepository->updateOrCreate([
                    'intangible_asset_id' => $intangibleAsset->id
                ], $newData);
                DB::commit();
                $message = __('pages.client.intangible_assets.phases.five.sub_phases.confidenciality_contract.messages.save_success');
            } catch (QueryException $qe) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetConfidencialityContract/Selected/QueryException: {$qe->getMessage()}");
            } catch (Exception $e) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetConfidencialityContract/Selected/Exception: {$e->getMessage()}");
                $this->fileConfidencialityContractService->deleteConfidencialityContractFile($intangibleAsset);
            }
        }

        return $message;
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param array $creators
     * 
     * @return string
     */
    private function updateIntangibleAssetCreators($intangibleAsset, $creators)
    {
        $message = __('pages.client.intangible_assets.phases.five.sub_phases.creators.messages.save_error');
        try {
            DB::beginTransaction();
            $intangibleAsset->creators()->sync($creators);
            DB::commit();
            $message = __('pages.client.intangible_assets.phases.five.sub_phases.creators.messages.save_success');
        } catch (QueryException $qe) {
            DB::rollBack();
            Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetCreators/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetCreators/Exception: {$e->getMessage()}");
        }

        return $message;
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param array $data
     * @param \Illuminate\Http\UploadedFile $file
     * 
     * @return string
     */
    private function updateIntangibleAssetSessionRightContract($intangibleAsset, $data)
    {
        $message = __('pages.client.intangible_assets.phases.five.sub_phases.session_right_contract.messages.save_error');

        if ($data['has_session_right'] == -1) {
            try {
                DB::beginTransaction();
                $this->fileSessionRightContractService->deleteSessionRightContractFile($intangibleAsset);
                $intangibleAsset->intangible_asset_session_right_contract()->delete();
                DB::commit();
                $message = __('pages.client.intangible_assets.phases.five.sub_phases.session_right_contract.messages.save_success');
            } catch (QueryException $qe) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetSessionRightContract/Unselected/QueryException: {$qe->getMessage()}");
            } catch (Exception $e) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetSessionRightContract/Unselected/Exception: {$e->getMessage()}");
            }
        } else {
            $newData = [];
            try {
                /** Store the File */
                $this->fileSessionRightContractService->deleteSessionRightContractFile($intangibleAsset);

                /** @var \Illuminate\Http\UploadedFile $file */
                $file = $data['file'];
                $filePath = '';
                $fileName = time() . ".{$file->getClientOriginalExtension()}";

                $fullPath = $filePath . $fileName;

                $this->fileSessionRightContractService->storeSessionRightContractFile($fullPath, $file);

                $newData['intangible_asset_id'] = $intangibleAsset->id;
                $newData['file'] = $fileName;
                $newData['file_path'] = $filePath;
                $newData['owner'] = $data['owner'];
                /** ./Store the File */

                DB::beginTransaction();
                $this->intangibleAssetSessionRightContractRepository->updateOrCreate([
                    'intangible_asset_id' => $intangibleAsset->id
                ], $newData);
                DB::commit();
                $message = __('pages.client.intangible_assets.phases.five.sub_phases.session_right_contract.messages.save_success');
            } catch (QueryException $qe) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetSessionRightContract/Selected/QueryException: {$qe->getMessage()}");
            } catch (Exception $e) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetSessionRightContract/Selected/Exception: {$e->getMessage()}");
                $this->fileSessionRightContractService->deleteSessionRightContractFile($intangibleAsset);
            }
        }
        return $message;
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param array $data
     * 
     * @return string
     */
    private function updateIntangibleAssetContability($intangibleAsset, $data)
    {
        $message = __('pages.client.intangible_assets.phases.five.sub_phases.contability.messages.save_error');

        if ($data['has_contability'] == -1) {
            try {
                DB::beginTransaction();
                $intangibleAsset->intangible_asset_contability()->delete();
                DB::commit();
                $message = __('pages.client.intangible_assets.phases.five.sub_phases.contability.messages.save_success');
            } catch (QueryException $qe) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetContability/Unselected/QueryException: {$qe->getMessage()}");
            } catch (Exception $e) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetContability/Unselected/Exception: {$e->getMessage()}");
            }
        } else {
            try {
                DB::beginTransaction();
                $data['intangible_asset_id'] = $intangibleAsset->id;
                $this->intangibleAssetContabilityRepository->updateOrCreate([
                    'intangible_asset_id' => $intangibleAsset->id
                ], $data);
                DB::commit();
                $message = __('pages.client.intangible_assets.phases.five.sub_phases.contability.messages.save_success');
            } catch (QueryException $qe) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetContability/Selected/QueryException: {$qe->getMessage()}");
            } catch (Exception $e) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetContability/Selected/Exception: {$e->getMessage()}");
            }
        }

        return $message;
    }

    /**
     * Intangible Asset Protection Action Deposite
     * 
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param array $data
     * 
     * @return string
     */
    private function updateIntangibleAssetProtectionAction($intangibleAsset, $data)
    {
        $message = __('pages.client.intangible_assets.phases.seven.sub_phases.has_deposite.messages.save_error');

        if ($data['has_protection_action'] == -1) {
            try {
                DB::beginTransaction();
                $intangibleAsset->intangible_asset_protection_action()->delete();
                DB::commit();
                $message = __('pages.client.intangible_assets.phases.seven.sub_phases.has_deposite.messages.save_success');
            } catch (QueryException $qe) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetProtectionAction/Unselected/QueryException: {$qe->getMessage()}");
            } catch (Exception $e) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetProtectionAction/Unselected/Exception: {$e->getMessage()}");
            }
        } else {
            try {
                DB::beginTransaction();
                $data['intangible_asset_id'] = $intangibleAsset->id;
                $this->intangibleAssetProtectionActionRepository->updateOrCreate([
                    'intangible_asset_id' => $intangibleAsset->id
                ], $data);
                DB::commit();
                $message = __('pages.client.intangible_assets.phases.seven.sub_phases.has_deposite.messages.save_success');
            } catch (QueryException $qe) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetProtectionAction/Unselected/QueryException: {$qe->getMessage()}");
            } catch (Exception $e) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetProtectionAction/Unselected/Exception: {$e->getMessage()}");
            }
        }

        return $message;
    }

    /**
     * 
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param array $data
     * 
     * @return string
     */
    public function updateIntangibleAssetSecretProtectionMeasures($intangibleAsset, $data)
    {
        $message = __('pages.client.intangible_assets.phases.seven.sub_phases.has_secret_protection.messages.save_error');

        if ($data['has_secret_protection'] == -1) {
            try {
                DB::beginTransaction();
                $intangibleAsset->secret_protection_measures()->delete();
                DB::commit();
                $message = __('pages.client.intangible_assets.phases.seven.sub_phases.has_secret_protection.messages.save_success');
            } catch (QueryException $qe) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetSecretProtectionMeasures/Unselected/QueryException: {$qe->getMessage()}");
            } catch (Exception $e) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetSecretProtectionMeasures/Unselected/Exception: {$e->getMessage()}");
            }
        } else {
            $secretProtectionMeasures = $data['secret_protection_measure_id'];
            try {
                DB::beginTransaction();
                $intangibleAsset->secret_protection_measures()->sync($secretProtectionMeasures);
                DB::commit();
                $message = __('pages.client.intangible_assets.phases.seven.sub_phases.has_secret_protection.messages.save_success');
            } catch (QueryException $qe) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetSecretProtectionMeasures/Unselected/QueryException: {$qe->getMessage()}");
            } catch (Exception $e) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetSecretProtectionMeasures/Unselected/Exception: {$e->getMessage()}");
            }
        }

        return $message;
    }

    /**
     * 
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param array $data
     * 
     * @return string
     */
    function updateIntangibleAssetAcademicRecord($intangibleAsset, $data)
    {
        $message = __('pages.client.intangible_assets.phases.five.sub_phases.academic_record.messages.save_error');

        if ($data['has_academic_record'] == -1) {
            try {
                DB::beginTransaction();
                $this->fileAcademicRecordService->deleteAcademicRecordFile($intangibleAsset);
                $intangibleAsset->intangible_asset_academic_record()->delete();
                DB::commit();
                $message = __('pages.client.intangible_assets.phases.five.sub_phases.academic_record.messages.save_success');
            } catch (QueryException $qe) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetAcademicRecord/Selected/QueryException: {$qe->getMessage()}");
            } catch (Exception $e) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetAcademicRecord/Selected/Exception: {$e->getMessage()}");
            }
            return $message;
        } else {
            $newData = [];
            try {
                /** Store the File */
                $this->fileAcademicRecordService->deleteAcademicRecordFile($intangibleAsset);

                /** @var \Illuminate\Http\UploadedFile $file */
                $file = $data['file'];
                $filePath = '';
                $fileName = time() . ".{$file->getClientOriginalExtension()}";

                $fullPath = $filePath . $fileName;

                $this->fileAcademicRecordService->storeAcademicRecordFile($fullPath, $file);

                $newData['intangible_asset_id'] = $intangibleAsset->id;
                $newData['entity'] = $data['entity'];
                $newData['administrative_record_num'] = $data['administrative_record_num'];
                $newData['date'] = $data['date'];
                $newData['file'] = $fileName;
                $newData['file_path'] = $filePath;
                /** ./Store the File */

                DB::beginTransaction();
                $this->intangibleAssetAcademicRecordRepository->updateOrCreate([
                    'intangible_asset_id' => $intangibleAsset->id
                ], $newData);
                DB::commit();
                $message = __('pages.client.intangible_assets.phases.five.sub_phases.academic_record.messages.save_success');
            } catch (QueryException $qe) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetAcademicRecord/Selected/QueryException: {$qe->getMessage()}");
            } catch (Exception $e) {
                DB::rollBack();
                Log::error("@Web/Services/IntangibleAssetPhaseService:UpdatePhaseFive/UpdateIntangibleAssetAcademicRecord/Selected/Exception: {$e->getMessage()}");
                $this->fileAcademicRecordService->deleteAcademicRecordFile($intangibleAsset);
            }
            return $message;
        }
    }
}
