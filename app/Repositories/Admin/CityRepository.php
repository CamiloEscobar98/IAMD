<?php

namespace App\Repositories\Admin;

use App\Repositories\AbstractRepository;

use Illuminate\Database\Eloquent\Builder;

use App\Models\Admin\Localization\City;

class CityRepository extends AbstractRepository
{
    /** @var City */
    protected $model;

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
        $joins = collect();
        $table = $this->model->getTable();
        $joinState = 'states';
        $query = $this->model
            ->select("$table.*");

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

        if (isset($params['country_id']) && $params['country_id']) {
            $this->addJoin($joins, $joinState, "{$joinState}.id", "{$table}.state_id");
            $query->ofCountry($params['country_id']);
        }

        if (isset($params['state_id']) && $params['state_id']) {
            $query->ofState($params['state_id']);
        }

        if (isset($with) && $with) {
            $query->with($with);
        }

        if (isset($params['order_by'])) {
            if ($params['order_by'] == 1) {
                $query->orderBy("{$this->model->getTable()}.name", 'ASC');
            } else {
                $query->orderBy("{$this->model->getTable()}.name", 'DESC');
            }
        } else {
            $query->orderBy("{$this->model->getTable()}.name", 'ASC');
        }
        $query->orderBy("{$this->model->getTable()}.state_id", 'ASC');

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
        $client = request('client');
        $joinCreatorDocument = "{$client}.creator_documents";
        $table =  $this->model->getTable();
        $query = $this->model
            ->select();

        $query->join($joinCreatorDocument, "{$joinCreatorDocument}.expedition_place_id", "{$table}.id");
        $query->ofCreator($creatorId);
        return $query;
    }
}
