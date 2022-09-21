<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\StrategyCategory;

class StrategyCategoryRepository extends  AbstractRepository
{
    public function __construct(StrategyCategory $model)
    {
        $this->model = $model;
    }
}
