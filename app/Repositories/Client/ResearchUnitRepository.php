<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\ResearchUnit;
use Illuminate\Database\Eloquent\Collection;

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

        if (isset($params['id']) && $params['id']) {
            $query->byId($params['id']);
        }

        if (isset($params['name']) && $params['name']) {
            $query->byName($params['name']);
        }

        if (isset($params['code']) && $params['code']) {
            $query->byCode($params['code']);
        }

        if (isset($params['administrative_unit_id']) && $params['administrative_unit_id']) {
            $query->byAdministrativeUnit($params['administrative_unit_id']);
        }

        if (isset($params['research_unit_category_id']) && $params['research_unit_category_id']) {
            $query->byResearchUnitCategory($params['research_unit_category_id']);
        }

        if (isset($params['director_id']) && $params['director_id']) {
            $query->byDirector($params['director_id']);
        }

        if (isset($params['inventory_manager_id']) && $params['inventory_manager_id']) {
            $query->byInventoryManager($params['inventory_manager_id']);
        }

        if (isset($params['date_from']) && $params['date_from']) {
            $query->sinceDate($params['date_from']);
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

    /**
     * @param \App\Models\Client\AdministrativeUnit $administrativeUnit
     * 
     * @return Collection
     */
    public function getByAdministrativeUnit($administrativeUnit): Collection
    {
        return $this->model->byAdministrativeUnit($administrativeUnit->id)->get();
    }
}
