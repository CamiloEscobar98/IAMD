<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\ProjectContractType;

class ProjectContractTypeRepository extends  AbstractRepository
{
    public function __construct(ProjectContractType $model)
    {
        $this->model = $model;
    }
}
