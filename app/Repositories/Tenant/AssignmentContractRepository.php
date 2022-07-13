<?php

namespace App\Repositories\Tenant;

use App\Repositories\AbstractRepository;

use App\Models\AssignmentContract;

class AssignmentContractRepository extends  AbstractRepository
{
    public function __construct(AssignmentContract $model)
    {
        $this->model = $model;
    }
}
