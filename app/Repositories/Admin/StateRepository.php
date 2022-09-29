<?php

namespace App\Repositories\Admin;

use App\Repositories\AbstractRepository;

use App\Models\Admin\Localization\State;
use Illuminate\Database\Eloquent\Collection;

class StateRepository extends AbstractRepository
{
    public function __construct(State $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * @param array $with
     * @param array $withCount
     * 
     * @return mixed
     */
    public function search(array $params = [], array $with = [], array $withCount = [], int $country_id = null)
    {
        $query = $this->model
            ->select();

        if (isset($country_id) && $country_id) {
            $query->where('country_id', $country_id);
        }

        if (isset($params['name']) && $params['name']) {
            $query->where('name', 'like', '%' . $params['name'] . '%');
        }

        if (isset($params['date_from']) && $params['date_from']) {
            $query->where('updated_at', '>=', $params['date_from']);
        }

        if (isset($params['date_to']) && $params['date_to']) {
            $query->where('updated_at', '<=', $params['date_to']);
        }

        if (isset($params['country_id']) && $params['country_id']) {
            $query->where('country_id', $params['country_id']);
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
     * @param \App\Models\Admin\Localization\Country $country
     * 
     * @return Collection
     */
    public function getByCountry($country): Collection
    {
        return $this->all()->where('country_id', $country->id);
    }
}
