<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\IntangibleAsset\IntangibleAssetSecretProtectionMeasure;

class IntangibleAssetSecretProtectionMeasureRepository extends  AbstractRepository
{
    public function __construct(IntangibleAssetSecretProtectionMeasure $model)
    {
        $this->model = $model;
    }
}
