<?php

namespace App\Repositories\Tenant;

use App\Models\Tenant\IntangibleAsset\IntangibleAssetCommercial;
use App\Repositories\AbstractRepository;

class IntangibleAssetCommercialRepository extends AbstractRepository 
{
    public function __construct(IntangibleAssetCommercial $model)
    {
        $this->model = $model;
    }
}
