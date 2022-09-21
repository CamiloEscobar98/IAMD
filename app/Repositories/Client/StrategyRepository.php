<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\Strategy;

class StrategyRepository extends  AbstractRepository
{
    public function __construct(Strategy $model)
    {
        $this->model = $model;
    }
}
