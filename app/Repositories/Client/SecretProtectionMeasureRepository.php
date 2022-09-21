<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\SecretProtectionMeasure;

class SecretProtectionMeasureRepository extends  AbstractRepository
{
    public function __construct(SecretProtectionMeasure $model)
    {
        $this->model = $model;
    }
}
