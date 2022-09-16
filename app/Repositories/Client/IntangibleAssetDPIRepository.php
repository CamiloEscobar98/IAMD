<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\IntangibleAsset\IntangibleAssetDPI;

class IntangibleAssetDPIRepository extends  AbstractRepository
{
    public function __construct(IntangibleAssetDPI $model)
    {
        $this->model = $model;
    }
}
