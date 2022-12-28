<?php

namespace App\Repositories\Admin;

use App\Repositories\AbstractRepository;

use Illuminate\Database\Eloquent\Builder;

use App\Models\Admin\Localization\City;

class CityRepository extends AbstractRepository
{
    public function __construct(City $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * @param array $with
     * @param array $withCount
     * @param int $stateId
     * 
     * @return mixed
     */
    public function search(array $params = [], array $with = [],  array $withCount = [], $stateId = null)
    {
        $query = $this->model
            ->select();

        if (isset($stateId) && $stateId) {
            $query->ofState($stateId);
        }

        if (isset($params['id']) && $params['id']) {
            $query->where('id', $params['id']);
        }

        if (isset($params['name']) && $params['name']) {
            $query->byName($params['name']);
        }

        if (isset($params['date_from']) && $params['date_from']) {
            $query->sinceDate($params['date_from']);
        }

        if (isset($params['date_to']) && $params['date_to']) {
            $query->toDate($params['date_to']);
        }

        if (isset($params['state_id']) && $params['state_id']) {
            $query->ofState($params['state_id']);
        }

        if (isset($with) && $with) {
            $query->with($with);
        }

        if (isset($withCount) && $withCount) {
            $query->withCount($withCount);
        }

        return $query;
    }

    /**
     * @param \App\Models\Admin\Localization\State $state
     * 
     * @return Collecion
     */
    public function getByState($state)
    {
        return $this->model->ofState($state->id)->get();
    }

    /**
     * 
     */
    public function getByCreator($creatorId)
    {
        return $this->model->ofCreator($creatorId);
    }
}
