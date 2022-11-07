<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\IntangibleAsset\IntangibleAsset;

class IntangibleAssetRepository extends AbstractRepository
{
    public function __construct(IntangibleAsset $model)
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

        $table = $this->model->getTable();

        $query = $this->model->select("{$table}.*");

        if (isset($params['id']) && $params['id']) {
            $query->byId($params['id']);
        }

        if (isset($params['name']) && $params['name']) {
            $query->byName($params['name']);
        }

        if (isset($params['code']) && $params['code']) {
            $query->byCode($params['code']);
        }

        if (isset($params['administrative_unit_id']) && $params['administrative_unit_id'] && isset($params['research_unit_id']) && $params['research_unit_id'] == 0) {
            $query->byAdministrativeUnit($params['administrative_unit_id']);
        }

        if (isset($params['research_unit_id']) && $params['research_unit_id']  && isset($params['project_id']) && $params['project_id'] == 0) {
            $query->byResearchUnit($params['research_unit_id']);
        }

        if (isset($params['project_id']) && $params['project_id'] > 0) {
            $query->byProject($params['project_id']);
        }

        if (isset($params['intangible_asset_state_id']) && $params['intangible_asset_state_id']) {
            if (is_array($params['intangible_asset_state_id'])) {
                $query->wherenIn('intangible_asset_state_id', $params['intangible_asset_state_id']);
            } else {
                $query->where('intangible_asset_state_id', $params['intangible_asset_state_id']);
            }
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

        $query->orderBy('date');

        // dd($query->get()->toArray());

        return $query;
    }

    public function searchForReport(array $params = [], array $with = [], array $withCount = [], array $select = [])
    {
        $query = $this->model->select($select);

        if (isset($params['id']) && $params['id']) {
            $query->byId($params['id']);
        }

        if (isset($params['name']) && $params['name']) {
            $query->byName($params['name']);
        }

        if (isset($params['code']) && $params['code']) {
            $query->byCode($params['code']);
        }

        // if (isset($params['intellectual_property_right_product_id']) && $params['intellectual_property_right_product_id'] > 0) {
        //     $query->byClassification($params['intellectual_property_right_product_id']);
        // }   

        if (isset($params['administrative_unit_id']) && $params['administrative_unit_id'] && isset($params['research_unit_id']) && $params['research_unit_id'] == 0) {
            $query->byAdministrativeUnit($params['administrative_unit_id']);
        }

        if (isset($params['research_unit_id']) && $params['research_unit_id']  && isset($params['project_id']) && $params['project_id'] == 0) {
            $query->byResearchUnit($params['research_unit_id']);
        }

        if (isset($params['project_id']) && $params['project_id'] > 0) {
            $query->byProject($params['project_id']);
        }

        if (isset($params['intangible_asset_state_id']) && $params['intangible_asset_state_id']) {
            if (is_array($params['intangible_asset_state_id'])) {
                $query->wherenIn('intangible_asset_state_id', $params['intangible_asset_state_id']);
            } else {
                $query->where('intangible_asset_state_id', $params['intangible_asset_state_id']);
            }
        }

        if (isset($params['phases']) && $params['phases']) {
            $query->byPhases($params['phases']);
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

        $query->orderBy('date');

        // dd($query->toSql());

        return $query;
    }
}
