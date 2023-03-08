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
     * @param array $params
     * @param array $with
     * @param array $withCount
     * 
     * @return $query
     */
    public function search(array $params = [], array $with = [], array $withCount = [])
    {
        $joins = collect();
        $joinProjectFinancing = 'project_financing';

        $query = $this->model
            ->select("{$this->model->getTable()}.*");

        if (isset($params['project_id']) && $params['project_id']) {
            $this->addJoin($joins, $joinProjectFinancing, "{$this->model->getTable()}.id", "{$joinProjectFinancing}.financing_type_id");
            $query->byProject($params['project_id']);
        }

        if (isset($with) && $with) {
            $query->with($with);
        }

        if (isset($withCount) && $withCount) {
            $query->withCount($withCount);
        }

        $joins->each(function ($item, $key) use ($query) {
            $item = json_decode($item, false);
            $query->join($key, $item->first, '=', $item->second, $item->join_type);
        });

        return $query;
    }

    /**
     * @param mixed $projectId
     */
    public function getByProject($projectId)
    {
        return $this->search(['project_id' => $projectId])->get();
    }
}
