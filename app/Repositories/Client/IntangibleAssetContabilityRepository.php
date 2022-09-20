<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\IntangibleAsset\IntangibleAssetContability;

class IntangibleAssetContabilityRepository extends AbstractRepository 
{
    public function __construct(IntangibleAssetContability $model)
    {
        $this->model = $model;
    }
}
