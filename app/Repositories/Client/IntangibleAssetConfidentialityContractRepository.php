<?php

namespace App\Repositories\Client;

use App\Models\Client\IntangibleAsset\IntangibleAssetConfidentialityContract;
use App\Repositories\AbstractRepository;

class IntangibleAssetConfidentialityContractRepository extends AbstractRepository 
{
    public function __construct(IntangibleAssetConfidentialityContract $model)
    {
        $this->model = $model;
    }
}
