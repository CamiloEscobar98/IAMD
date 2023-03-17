<?php

namespace App\Repositories\Client;

use App\Models\Client\IntangibleAsset\IntangibleAssetAcademicRecord;
use App\Repositories\AbstractRepository;

class IntangibleAssetAcademicRecordRepository extends AbstractRepository 
{
    public function __construct(IntangibleAssetAcademicRecord $model)
    {
        $this->model = $model;
    }
}
