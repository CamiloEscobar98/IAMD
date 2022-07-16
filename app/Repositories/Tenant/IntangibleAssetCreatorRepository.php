<?php

namespace App\Repositories\Tenant;

use App\Repositories\AbstractRepository;

use App\Models\Tenant\IntangibleAsset\IntangibleAssetCreator;

class IntangibleAssetCreatorRepository extends  AbstractRepository
{
    public function __construct(IntangibleAssetCreator $model)
    {
        $this->model = $model;
    }
}
