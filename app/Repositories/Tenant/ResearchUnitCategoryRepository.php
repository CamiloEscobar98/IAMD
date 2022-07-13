<?php

namespace App\Repositories\Tenant;

use App\Models\Tenant\ResearchUnitCategory;
use App\Repositories\AbstractRepository;

class ResearchUnitCategoryRepository extends  AbstractRepository
{
    public function __construct(ResearchUnitCategory $model)
    {
        $this->model = $model;
    }
}
