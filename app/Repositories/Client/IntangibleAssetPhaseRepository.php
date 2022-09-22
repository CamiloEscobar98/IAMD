<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\IntangibleAsset\IntangibleAssetPhase;

class IntangibleAssetPhaseRepository extends  AbstractRepository
{
    public function __construct(IntangibleAssetPhase $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $intangibleAssetId
     * @param string $phase
     * @param ?bool $notCompleted
     * 
     * @return void
     */
    public function updatePhase(int $intangibleAssetId, string $phase, $notCompleted = true)
    {
        $this->updateOrCreate([
            'intangible_asset_id' => $intangibleAssetId,

        ], ["phase_{$phase}_completed" => $notCompleted]);
    }
}
