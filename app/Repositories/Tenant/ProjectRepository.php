<?php

namespace App\Repositories\Tenant;

use App\Repositories\AbstractRepository;

use App\Models\Tenant\Project;

class ProjectRepository extends  AbstractRepository
{
    public function __construct(Project $model)
    {
        $this->model = $model;
    }
}
