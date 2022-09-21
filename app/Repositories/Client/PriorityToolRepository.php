<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\PriorityTool;

class PriorityToolRepository extends  AbstractRepository
{
    public function __construct(PriorityTool $model)
    {
        $this->model = $model;
    }
}
