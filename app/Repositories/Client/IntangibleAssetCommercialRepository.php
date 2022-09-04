<?php

namespace App\Repositories\Client;

use App\Models\Client\IntangibleAsset\IntangibleAssetCommercial;
use App\Repositories\AbstractRepository;

class IntangibleAssetCommercialRepository extends AbstractRepository 
{
    public function __construct(IntangibleAssetCommercial $model)
    {
        $this->model = $model;
    }
}
