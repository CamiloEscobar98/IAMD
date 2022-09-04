<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\FinancingType;

class FinancingTypeRepository  extends AbstractRepository
{
    public function __construct(FinancingType $model)
    {
        $this->model = $model;
    }
}
