<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\IntangibleAsset\IntangibleAssetProtectionAction;

class IntangibleAssetProtectionActionRepository extends  AbstractRepository
{
    public function __construct(IntangibleAssetProtectionAction $model)
    {
        $this->model = $model;
    }
}
