<?php

namespace App\Repositories\Client;

use App\Models\Client\Project\Project;
use App\Repositories\AbstractRepository;

use App\Models\Client\Project\ProjectFinancing;

class ProjectFinancingRepository extends  AbstractRepository
{
    public function __construct(ProjectFinancing $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $projectId
     */
    public function getByProject($projectId)
    {
        return $this->model->byProject($projectId)->get();
    }
}
