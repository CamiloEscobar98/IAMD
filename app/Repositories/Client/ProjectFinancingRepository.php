<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\Project\ProjectFinancing;

class ProjectFinancingRepository extends  AbstractRepository
{
    public function __construct(ProjectFinancing $model)
    {
        $this->model = $model;
    }
}