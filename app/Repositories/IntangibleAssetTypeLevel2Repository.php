<?php

namespace App\Repositories;

use App\Models\IntangibleAssetTypes\IntangibleAssetTypeLevel2;

class IntangibleAssetTypeLevel2Repository extends AbstractRepository 
{
    public function __construct(IntangibleAssetTypeLevel2 $model)
    {
        $this->model = $model;
    }
}
