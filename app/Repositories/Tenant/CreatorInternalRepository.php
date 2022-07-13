<?php

namespace App\Repositories\Tenant;

use App\Models\Tenant\CreatorInternal;
use App\Repositories\AbstractRepository;

class CreatorInternalRepository extends  AbstractRepository
{
    public function __construct(CreatorInternal $model)
    {
        $this->model = $model;
    }
}
