<?php

namespace App\Repositories\Admin;

use App\Repositories\AbstractRepository;

use Illuminate\Database\Eloquent\Collection;

use App\Models\Admin\Localization\State;

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
     * @param int|null $countryId
     * 
     * @return mixed
     */
    public function search(array $params = [], array $with = [], array $withCount = [], int|null $countryId = null)
    {
        $query = $this->model
            ->select();

        if (isset($countryId) && $countryId) {
            $query->ofCountry($countryId);
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

        if (isset($params['country_id']) && $params['country_id']) {
            $query->ofCountry($params['country_id']);
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
        return $this->model->ofCountry($country->id)->get();
    }
}
