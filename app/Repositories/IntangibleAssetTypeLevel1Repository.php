<?php

namespace App\Repositories;

use App\Models\IntangibleAssetTypes\IntangibleAssetTypeLevel1;

class IntangibleAssetTypeLevel1Repository extends AbstractRepository 
{
    public function __construct(IntangibleAssetTypeLevel1 $model)
    {
        $this->model = $model;
    }
}
