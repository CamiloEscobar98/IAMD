<?php

namespace App\Repositories\Admin;

use App\Repositories\AbstractRepository;

use App\Models\Admin\IntangibleAssetTypeLevel\IntangibleAssetTypeLevel3;

class IntangibleAssetTypeLevel3Repository extends AbstractRepository 
{
    public function __construct(IntangibleAssetTypeLevel3 $model)
    {
        $this->model = $model;
    }
}
