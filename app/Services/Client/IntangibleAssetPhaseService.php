<?php

namespace App\Services\Client;

use Illuminate\Support\Facades\DB;

use App\Repositories\Client\IntangibleAssetRepository;
use App\Repositories\Client\IntangibleAssetCommercialRepository;
use App\Repositories\Client\IntangibleAssetConfidentialityContractRepository;
use App\Repositories\Client\IntangibleAssetCreatorRepository;
use App\Repositories\Client\IntangibleAssetPublishedRepository;
use App\Repositories\Client\IntangibleAssetDPIRepository;
use App\Repositories\Client\IntangibleAssetSessionRightContractRepository;
use App\Services\FileSystem\IntangibleAsset\FileConfidencialityContractService;
use App\Services\FileSystem\IntangibleAsset\FileSessionRightContractService;
use Illuminate\Support\Facades\Storage;

class IntangibleAssetPhaseService
{
    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    /** @var IntangibleAssetCommercialRepository */
    protected $intangibleAssetCommercialRepository;

    /** @var IntangibleAssetCreatorRepository */
    protected $intangibleAssetCreatorRepository;

    /** @var IntangibleAssetPublishedRepository */
    protected $intangibleAssetPublishedRepository;

    /** @var IntangibleAssetDPIRepository */
    protected $intangibleAssetDPIRepository;

    /** @var IntangibleAssetConfidentialityContractRepository */
    protected $intangibleAssetConfidentialityContractRepository;

    /** @var IntangibleAssetSessionRightContractRepository */
    protected $intangibleAssetSessionRightContractRepository;

    /** @var FileConfidencialityContractService */
    protected $fileConfidencialityContractService;

    /** @var FileSessionRightContractService */
    protected $fileSessionRightContractService;

    public function __construct(
        IntangibleAssetRepository $intangibleAssetRepository,
        IntangibleAssetCommercialRepository $intangibleAssetCommercialRepository,
        IntangibleAssetPublishedRepository $intangibleAssetPublishedRepository,
        IntangibleAssetConfidentialityContractRepository $intangibleAssetConfidentialityContractRepository,
        IntangibleAssetSessionRightContractRepository $intangibleAssetSessionRightContractRepository,

        IntangibleAssetDPIRepository $intangibleAssetDPIRepository,
        IntangibleAssetCreatorRepository $intangibleAssetCreatorRepository,

        FileConfidencialityContractService $fileConfidencialityContractService,
        FileSessionRightContractService $fileSessionRightContractService,
    ) {
        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->intangibleAssetCommercialRepository = $intangibleAssetCommercialRepository;
        $this->intangibleAssetPublishedRepository = $intangibleAssetPublishedRepository;
        $this->intangibleAssetConfidentialityContractRepository = $intangibleAssetConfidentialityContractRepository;
        $this->intangibleAssetSessionRightContractRepository = $intangibleAssetSessionRightContractRepository;

        $this->intangibleAssetDPIRepository = $intangibleAssetDPIRepository;
        $this->intangibleAssetCreatorRepository = $intangibleAssetCreatorRepository;

        $this->fileConfidencialityContractService = $fileConfidencialityContractService;
        $this->fileSessionRightContractService = $fileSessionRightContractService;
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
        try {
            $this->intangibleAssetRepository->update($intangibleAsset, ['classification_id'  => $data['intangible_asset_type_level_3']]);

            return __('pages.client.intangible_assets.phases.one.messages.save_success', ['intangible_asset' => $intangibleAsset->name]);
        } catch (\Exception $th) {
            return __('pages.client.intangible_assets.phases.one.messages.save_error');
        }
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
        try {
            $this->intangibleAssetRepository->update($intangibleAsset, $data);

            return __('pages.client.intangible_assets.phases.two.messages.save_success', ['intangible_asset' => $intangibleAsset->name]);
        } catch (\Exception $th) {
            return __('pages.client.intangible_assets.phases.two.messages.save_error');
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
    public function updatePhaseThree($intangibleAsset, $data): string
    {
        try {
            $this->intangibleAssetRepository->update($intangibleAsset, $data);

            return __('pages.client.intangible_assets.phases.three.messages.save_success', ['intangible_asset' => $intangibleAsset->name]);
        } catch (\Exception $th) {
            return __('pages.client.intangible_assets.phases.three.messages.save_error');
        }
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
        try {

            $intangibleAsset->dpis()->delete();

            foreach ($dpis as $dpi) {
                $this->intangibleAssetDPIRepository->create([
                    'intangible_asset_id' => $intangibleAsset->id,
                    'dpi_id' => $dpi
                ]);
            }

            return __('pages.client.intangible_assets.phases.four.messages.save_success', ['intangible_asset' => $intangibleAsset->name]);
        } catch (\Exception $th) {
            return __('pages.client.intangible_assets.phases.four.messages.save_error');
        }
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
        try {
            $message = null;
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
            }

            return $message;
        } catch (\Exception $th) {
            return __('pages.client.intangible_assets.phases.five.messages.save_error');
        }
    }

    /**
     * @param \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
     * @param array $data
     * 
     * @return string
     */
    private function updateIntangibleAssetPublished($intangibleAsset, $data)
    {
        $message = __('pages.client.intangible_assets.phases.five.sub_phases.is_published.messages.save_success', ['intangible_asset' => $intangibleAsset->name]);

        if ($data['is_published'] == -1) {
            try {
                DB::beginTransaction();
                $intangibleAsset->intangible_asset_published()->delete();
                DB::commit();
            } catch (\Exception $th) {
                DB::rollBack();
                $message = __('pages.client.intangible_assets.phases.five.sub_phases.is_published.messages.save_error', ['intangible_asset' => $intangibleAsset->name]);
            }
        } else {
            try {
                DB::beginTransaction();
                $data['intangible_asset_id'] = $intangibleAsset->id;
                $this->intangibleAssetPublishedRepository->updateOrCreate([
                    'intangible_asset_id' => $intangibleAsset->id
                ], $data);

                DB::commit();
            } catch (\Exception $th) {
                DB::rollBack();
                $message = __('pages.client.intangible_assets.phases.five.sub_phases.is_published.messages.save_error', ['intangible_asset' => $intangibleAsset->name]);
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
        $message = __('pages.client.intangible_assets.phases.five.sub_phases.confidenciality_contract.messages.save_success', ['intangible_asset' => $intangibleAsset->name]);

        if ($data['has_confidenciality_contract'] == -1) {
            $this->fileConfidencialityContractService->deleteConfidencialityContractFile($intangibleAsset);
            $intangibleAsset->intangible_asset_confidenciality_contract()->delete();
        } else {
            $newData = [];

            try {
                DB::beginTransaction();

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

                $this->intangibleAssetConfidentialityContractRepository->updateOrCreate([
                    'intangible_asset_id' => $intangibleAsset->id
                ], $newData);
                DB::commit();
            } catch (\Exception $th) {
                DB::rollBack();
                $this->fileConfidencialityContractService->deleteConfidencialityContractFile($intangibleAsset);

                $message = __('pages.client.intangible_assets.phases.five.sub_phases.confidenciality_contract.messages.save_error', ['intangible_asset' => $intangibleAsset->name]);
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
        $message = __('pages.client.intangible_assets.phases.five.sub_phases.creators.messages.save_success', ['intangible_asset' => $intangibleAsset->name]);
        try {
            DB::beginTransaction();

            $intangibleAsset->creators()->sync($creators);

            DB::commit();
        } catch (\Exception $th) {
            DB::rollBack();
            dd($th->getMessage());
            // $message = __('pages.client.intangible_assets.phases.five.sub_phases.creators.messages.save_error', ['intangible_asset' => $intangibleAsset->name]);
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
        $message = __('pages.client.intangible_assets.phases.five.sub_phases.session_right_contract.messages.save_success', ['intangible_asset' => $intangibleAsset->name]);

        if ($data['has_session_right'] == -1) {
            $this->fileSessionRightContractService->deleteSessionRightContractFile($intangibleAsset);
            $intangibleAsset->intangible_asset_session_right_contract()->delete();
        } else {
            $newData = [];

            try {
                DB::beginTransaction();

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

                $this->intangibleAssetSessionRightContractRepository->updateOrCreate([
                    'intangible_asset_id' => $intangibleAsset->id
                ], $newData);
                DB::commit();
            } catch (\Exception $th) {
                DB::rollBack();
                $message = $th->getMessage();
                $this->fileSessionRightContractService->deleteSessionRightContractFile($intangibleAsset);

                // $message = __('pages.client.intangible_assets.phases.five.sub_phases.session_right_contract.messages.save_error', ['intangible_asset' => $intangibleAsset->name]);
            }
        }

        return $message;
    }
}
