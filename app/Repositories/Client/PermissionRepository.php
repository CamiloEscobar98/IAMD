<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\Permission;

class PermissionRepository  extends AbstractRepository
{
    public function __construct(Permission $model)
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
            $query->byName($params['name']);
        }

        if (isset($params['date_from']) && $params['date_from']) {
            $query->sinceDate($params['date_from']);
        }

        if (isset($params['permission_module_id']) && $params['permission_module_id']) {
            $query->byPermissionModule($params['permission_module_id']);
        }

        if (isset($params['date_to']) && $params['date_to']) {
            $query->toDate($params['date_to']);
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
