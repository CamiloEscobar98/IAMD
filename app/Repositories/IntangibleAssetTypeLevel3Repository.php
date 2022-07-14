<?php

namespace App\Repositories;

use App\Models\IntangibleAssetTypes\IntangibleAssetTypeLevel3;

class IntangibleAssetTypeLevel3Repository extends AbstractRepository 
{
    public function __construct(IntangibleAssetTypeLevel3 $model)
    {
        $this->model = $model;
    }
}
