<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\IntangibleAsset\IntangibleAssetDpiPriorityTool;

class IntangibleAssetDpiPriorityToolRepository extends  AbstractRepository
{
    public function __construct(IntangibleAssetDpiPriorityTool $model)
    {
        $this->model = $model;
    }
}
