<?php

namespace App\Repositories\Admin;

use App\Repositories\AbstractRepository;

use App\Models\Admin\IntangibleAssetTypeLevel\IntangibleAssetTypeLevel2;

class IntangibleAssetTypeLevel2Repository extends AbstractRepository 
{
    public function __construct(IntangibleAssetTypeLevel2 $model)
    {
        $this->model = $model;
    }
}
