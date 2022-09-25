<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\Strategy;

class StrategyRepository extends  AbstractRepository
{
    public function __construct(Strategy $model)
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
