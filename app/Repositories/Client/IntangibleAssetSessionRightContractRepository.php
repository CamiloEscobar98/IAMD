<?php

namespace App\Repositories\Client;

use App\Models\Client\IntangibleAsset\IntangibleAssetSessionRightContract;
use App\Repositories\AbstractRepository;

class IntangibleAssetSessionRightContractRepository extends AbstractRepository 
{
    public function __construct(IntangibleAssetSessionRightContract $model)
    {
        $this->model = $model;
    }
}
