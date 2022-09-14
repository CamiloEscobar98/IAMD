<?php

namespace App\Services\Client;

use App\Repositories\Client\IntangibleAssetRepository;
use App\Repositories\Client\IntangibleAssetCommercialRepository;
use App\Repositories\Client\IntangibleAssetCreatorRepository;
use App\Repositories\Client\IntangibleAssetPublishedRepository;

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

    public function __construct(
        IntangibleAssetRepository $intangibleAssetRepository,
        IntangibleAssetCommercialRepository $intangibleAssetCommercialRepository,
        IntangibleAssetCreatorRepository $intangibleAssetCreatorRepository,
        IntangibleAssetPublishedRepository $intangibleAssetPublishedRepository,
    ) {
        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->intangibleAssetCommercialRepository = $intangibleAssetCommercialRepository;
        $this->intangibleAssetCreatorRepository = $intangibleAssetCreatorRepository;
        $this->intangibleAssetPublishedRepository = $intangibleAssetPublishedRepository;
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
     * Intangible Asset Phase One: Intangible Asset Description
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
     * Intangible Asset Phase One: Intangible Asset State
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
}
