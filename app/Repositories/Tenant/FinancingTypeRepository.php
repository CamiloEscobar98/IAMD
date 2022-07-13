<?php

namespace App\Repositories\Tenant;

use App\Repositories\AbstractRepository;

use App\Models\Tenant\FinancingType;

class FinancingTypeRepository  extends AbstractRepository
{
    public function __construct(FinancingType $model)
    {
        $this->model = $model;
    }
}
