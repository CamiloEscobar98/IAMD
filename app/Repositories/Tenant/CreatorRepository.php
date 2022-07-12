<?php

namespace App\Repositories\Tenant;

use App\Repositories\AbstractRepository;

use App\Models\Tenant\Creator;

class CreatorRepository extends AbstractRepository
{
    public function __construct(Creator $model)
    {
        $this->model = $model;
    }
}
