<?php

namespace App\Repositories\Tenant;

use App\Repositories\AbstractRepository;

use App\Models\Tenant\ResearchUnit;

class ResearchUnitRepository extends  AbstractRepository
{
    public function __construct(ResearchUnit $model)
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

        if (isset($params['name']) && $params['name']) {
            $query->where('name', 'like', '%' . $params['name'] . '%');
        }

        if (isset($params['code']) && $params['code']) {
            $query->where('code', 'like', '%' . $params['code'] . '%');
        }

        if (isset($params['administrative_unit_id']) && $params['administrative_unit_id']) {
            if (is_array($params['administrative_unit_id'])) {
                $query->wherenIn('administrative_unit_id', $params['administrative_unit_id']);
            } else {
                $query->where('administrative_unit_id', $params['administrative_unit_id']);
            }
        }

        if (isset($params['research_unit_category_id']) && $params['research_unit_category_id']) {
            if (is_array($params['research_unit_category_id'])) {
                $query->wherenIn('research_unit_category_id', $params['research_unit_category_id']);
            } else {
                $query->where('research_unit_category_id', $params['research_unit_category_id']);
            }
        }

        if (isset($params['director_id']) && $params['director_id']) {
            if (is_array($params['director_id'])) {
                $query->wherenIn('director_id', $params['director_id']);
            } else {
                $query->where('director_id', $params['director_id']);
            }
        }

        if (isset($params['inventory_manager_id']) && $params['inventory_manager_id']) {
            if (is_array($params['inventory_manager_id'])) {
                $query->wherenIn('inventory_manager_id', $params['inventory_manager_id']);
            } else {
                $query->where('inventory_manager_id', $params['inventory_manager_id']);
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
