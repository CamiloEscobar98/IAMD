<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\IntangibleAsset\IntangibleAssetStrategy;

class IntangibleAssetStrategyRepository extends  AbstractRepository
{
    public function __construct(IntangibleAssetStrategy $model)
    {
        $this->model = $model;
    }
}
