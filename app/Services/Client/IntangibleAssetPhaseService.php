<?php

namespace App\Services\Client;

use App\Repositories\Client\IntangibleAssetRepository;
use App\Repositories\Client\IntangibleAssetCommercialRepository;
use App\Repositories\Client\IntangibleAssetCreatorRepository;
use App\Repositories\Client\IntangibleAssetPublishedRepository;
use App\Repositories\Client\IntangibleAssetDPIRepository;

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

    public function __construct(
        IntangibleAssetRepository $intangibleAssetRepository,
        IntangibleAssetCommercialRepository $intangibleAssetCommercialRepository,
        IntangibleAssetCreatorRepository $intangibleAssetCreatorRepository,
        IntangibleAssetPublishedRepository $intangibleAssetPublishedRepository,

        IntangibleAssetDPIRepository $intangibleAssetDPIRepository,
    ) {
        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->intangibleAssetCommercialRepository = $intangibleAssetCommercialRepository;
        $this->intangibleAssetCreatorRepository = $intangibleAssetCreatorRepository;
        $this->intangibleAssetPublishedRepository = $intangibleAssetPublishedRepository;
        $this->intangibleAssetDPIRepository = $intangibleAssetDPIRepository;
    }

    /**
     * Intangible Asset Phase One: Intangible Asset Classification
     * @param \App\MOdels\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
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
     * @param \App\MOdels\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
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
     * @param \App\MOdels\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
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
     * @param \App\MOdels\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
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
     * @param \App\MOdels\Client\IntangibleAsset\IntangibleAsset $intangibleAsset
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
                    if ($data['is_published'] == -1) {
                        $intangibleAsset->intangible_asset_published()->delete();
                    } else {
                        $data['intangible_asset_id'] = $intangibleAsset->id;
                        $this->intangibleAssetPublishedRepository->updateOrCreate([
                            'intangible_asset_id' => $intangibleAsset->id
                        ], $data);
                    }
                    $message = __('pages.client.intangible_assets.phases.five.sub_phases.is_published.messages.save_success', ['intangible_asset' => $intangibleAsset->name]);
                    break;

                default:
                    # code...
                    break;
            }

            return $message;
        } catch (\Exception $th) {
            return __('pages.client.intangible_assets.phases.five.messages.save_error');
        }
    }
}
