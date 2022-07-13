<?php

namespace App\Repositories\Tenant;

use App\Repositories\AbstractRepository;

use App\Models\Tenant\ProjectContractType;

class ProjectContractTypeRepository extends  AbstractRepository
{
    public function __construct(ProjectContractType $model)
    {
        $this->model = $model;
    }
}
