<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use Illuminate\Database\Eloquent\Collection;

use App\Models\Client\ResearchUnit;

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
     * @return \Illuminate\Database\Query\Builder
     */
    public function search(array $params = [], array $with = [], array $withCount = [])
    {
        $joins = collect();
        $table = $this->model->getTable();
        $joinResearchUnitProject = 'project_research_unit';

        $query = $this->model
            ->select("{$table}.*");

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

        if (isset($params['project_id']) && $params['project_id']) {
            $this->addJoin($joins, $joinResearchUnitProject, "{$table}.id", "{$joinResearchUnitProject}.research_unit_id");
            $query->byProject($params['project_id']);
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

        
        $joins->each(function ($item, $key) use ($query) {
            $item = json_decode($item, false);
            $query->join($key, $item->first, '=', $item->second, $item->join_type);
        });
        
        return $query;
    }
}
