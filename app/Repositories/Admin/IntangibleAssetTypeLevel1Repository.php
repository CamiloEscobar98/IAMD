<?php

namespace App\Repositories\Admin;

use App\Repositories\AbstractRepository;

use App\Models\Admin\IntangibleAssetTypeLevel\IntangibleAssetTypeLevel1;

class IntangibleAssetTypeLevel1Repository extends AbstractRepository 
{
    public function __construct(IntangibleAssetTypeLevel1 $model)
    {
        $this->model = $model;
    }
}
