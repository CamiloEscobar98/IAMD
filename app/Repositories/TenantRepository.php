<?php

namespace App\Repositories;

use App\Models\Tenant;

class TenantRepository extends  AbstractRepository
{
    public function __construct(Tenant $model)
    {
        $this->model = $model;
    }
}
