<?php

namespace App\Observers;

use App\Models\Client\IntangibleAsset\IntangibleAsset;

use App\Repositories\Client\IntangibleAssetPhaseRepository;
use App\Repositories\Client\IntangibleAssetLocalizationRepository;

class IntangibleAssetObserver
{
    /** @var IntangibleAssetPhaseRepository */
    protected $intangibleAssetPhaseRepository;

    /** @var IntangibleAssetLocalizationRepository */
    protected $intangibleAssetLocalizationRepository;

    public function __construct(
        IntangibleAssetPhaseRepository $intangibleAssetPhaseRepository,
        IntangibleAssetLocalizationRepository $intangibleAssetLocalizationRepository
    ) {
        $this->intangibleAssetPhaseRepository = $intangibleAssetPhaseRepository;
        $this->intangibleAssetLocalizationRepository = $intangibleAssetLocalizationRepository;
    }

    /**
     * Handle the IntangibleAsset "created" event.
     *
     * @param  \App\Models\IntangibleAsset  $intangibleAsset
     * @return void
     */
    public function created(IntangibleAsset $intangibleAsset)
    {
        $this->intangibleAssetPhaseRepository->create(['intangible_asset_id' => $intangibleAsset->id]);
        $this->intangibleAssetLocalizationRepository->createOneFactory(['intangible_asset_id' => $intangibleAsset->id]);
    }

    /**
     * Handle the IntangibleAsset "updated" event.
     *
     * @param  \App\Models\IntangibleAsset  $intangibleAsset
     * @return void
     */
    public function updated(IntangibleAsset $intangibleAsset)
    {
        //
    }

    /**
     * Handle the IntangibleAsset "deleted" event.
     *
     * @param  \App\Models\IntangibleAsset  $intangibleAsset
     * @return void
     */
    public function deleted(IntangibleAsset $intangibleAsset)
    {
        //
    }

    /**
     * Handle the IntangibleAsset "restored" event.
     *
     * @param  \App\Models\IntangibleAsset  $intangibleAsset
     * @return void
     */
    public function restored(IntangibleAsset $intangibleAsset)
    {
        //
    }

    /**
     * Handle the IntangibleAsset "force deleted" event.
     *
     * @param  \App\Models\IntangibleAsset  $intangibleAsset
     * @return void
     */
    public function forceDeleted(IntangibleAsset $intangibleAsset)
    {
        //
    }
}
