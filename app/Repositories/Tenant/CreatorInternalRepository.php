<?php

namespace App\Repositories\Tenant;

use App\Repositories\AbstractRepository;

use App\Models\Tenant\Creator\CreatorInternal;

class CreatorInternalRepository extends  AbstractRepository
{
    public function __construct(CreatorInternal $model)
    {
        $this->model = $model;
    }
}
