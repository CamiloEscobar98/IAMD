<?php

namespace App\Repositories\Tenant;

use App\Repositories\AbstractRepository;

use App\Models\Tenant\IntangibleAsset\IntangibleAsset;

class IntangibleAssetRepository extends AbstractRepository
{
    public function __construct(IntangibleAsset $model)
    {
        $this->model = $model;
    }
}
