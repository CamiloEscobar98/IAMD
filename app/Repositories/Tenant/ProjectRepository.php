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

    /**
     * @param array $params
     * @param array $with
     * @param array $withCount
     * 
     * @return $query
     */
    public function search(array $params = [], array $with = [], array $withCount = [])
    {
        $query = $this->model
            ->select();

        if (isset($params['id']) && $params['id']) {
            $query->where('id', $params['id']);
        }

        if (isset($params['name']) && $params['name']) {
            $query->where('name', 'like', '%' . $params['name'] . '%');
        }

        if (isset($params['research_unit_id']) && $params['research_unit_id']) {
            if (is_array($params['research_unit_id'])) {
                $query->wherenIn('research_unit_id', $params['research_unit_id']);
            } else {
                $query->where('research_unit_id', $params['research_unit_id']);
            }
        }

        if (isset($params['director_id']) && $params['director_id']) {
            if (is_array($params['director_id'])) {
                $query->wherenIn('director_id', $params['director_id']);
            } else {
                $query->where('director_id', $params['director_id']);
            }
        }

        if (isset($params['date_from']) && $params['date_from']) {
            $query->where('updated_at', '>=', $params['date_from']);
        }

        if (isset($params['date_to']) && $params['date_to']) {
            $query->where('updated_at', '<=', $params['date_to']);
        }

        if (isset($with) && $with) {
            $query->with($with);
        }

        if (isset($withCount) && $withCount) {
            $query->withCount($withCount);
        }

        return $query;
    }
}
