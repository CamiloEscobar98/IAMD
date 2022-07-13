<?php

namespace App\Repositories\Tenant;

use App\Repositories\AbstractRepository;

use App\Models\Tenant\ResearchUnit;

class ResearchUnitRepository extends  AbstractRepository
{
    public function __construct(ResearchUnit $model)
    {
        $this->model = $model;
    }
}
