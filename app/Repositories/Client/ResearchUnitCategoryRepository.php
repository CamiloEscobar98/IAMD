<?php

namespace App\Repositories\Client;

use App\Models\Client\ResearchUnitCategory;
use App\Repositories\AbstractRepository;

class ResearchUnitCategoryRepository extends  AbstractRepository
{
    public function __construct(ResearchUnitCategory $model)
    {
        $this->model = $model;
    }
}
