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

        if (isset($params['project_id']) && $params['project_id']) {
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

        $query->orderBy("{$table}.date");

        return $query;
    }

    public function searchForReport(array $params = [], array $with = [], array $withCount = [], array $select = [])
    {
        $joins = collect();

        $query = $this->model
            ->select($select);

        if (isset($params['id']) && $params['id']) {
            $query->byId($params['id']);
        }

        if (isset($params['name']) && $params['name']) {
            $query->byName($params['name']);
        }

        if (isset($params['code']) && $params['code']) {
            $query->byCode($params['code']);
        }


        if (isset($params['intellectual_property_right_product_id']) && $params['intellectual_property_right_product_id'] > 0) {
            $query->byClassification($params['intellectual_property_right_product_id']);
        }


        if (isset($params['intellectual_property_right_subcategory_id']) && $params['intellectual_property_right_subcategory_id'] > 0) {
            $joinIntellectualPropertyRightProduct = 'iamd.intellectual_property_right_products';
            $this->addJoin($joins, $joinIntellectualPropertyRightProduct, "{$this->model->getTable()}.classification_id", "$joinIntellectualPropertyRightProduct.id");
            $query->bySubcategory($params['intellectual_property_right_subcategory_id']);
        }

        if (isset($params['intellectual_property_right_category_id']) && $params['intellectual_property_right_category_id'] > 0) {
            $joinIntellectualPropertyRightProduct = 'iamd.intellectual_property_right_products';
            $this->addJoin($joins, $joinIntellectualPropertyRightProduct, "{$this->model->getTable()}.classification_id", "$joinIntellectualPropertyRightProduct.id");
            $joinIntellectualPropertyRightSubcategory = 'iamd.intellectual_property_right_subcategories';
            $this->addJoin($joins, $joinIntellectualPropertyRightSubcategory, "$joinIntellectualPropertyRightProduct.intellectual_property_right_subcategory_id", "$joinIntellectualPropertyRightSubcategory.id");
            $query->byCategory($params['intellectual_property_right_category_id']);
        }

        if (isset($params['project_id']) && $params['project_id'] > 0) {
            $query->byProject($params['project_id']);
        }

        if (isset($params['intangible_asset_state_id']) && $params['intangible_asset_state_id']) {
            $query->byState($params['intangible_asset_state_id']);
        }

        if (isset($params['research_unit_id']) && $params['research_unit_id']) {
            $joinResearchUnitIntangibleAsset = 'intangible_asset_research_unit';
            $this->addJoin($joins, $joinResearchUnitIntangibleAsset, "{$this->model->getTable()}.id", "{$joinResearchUnitIntangibleAsset}.intangible_asset_id");
            $query->byResearchUnit($params['research_unit_id']);
        }

        if (isset($params['creator_id']) && $params['creator_id']) {
            $joinCreatorsIntangibleAsset = 'intangible_asset_creators';
            $this->addJoin($joins, $joinCreatorsIntangibleAsset, "{$this->model->getTable()}.id", "{$joinCreatorsIntangibleAsset}.intangible_asset_id");
            $query->byCreator($params['creator_id']);
        }

        if (isset($params['administrative_unit_id']) && $params['administrative_unit_id']) {
            $joinResearchUnitIntangibleAsset = 'intangible_asset_research_unit';
            $this->addJoin($joins, $joinResearchUnitIntangibleAsset, "{$this->model->getTable()}.id", "{$joinResearchUnitIntangibleAsset}.intangible_asset_id");
            $joinResearchUnit = 'research_units';
            $this->addJoin($joins, $joinResearchUnit, "$joinResearchUnitIntangibleAsset.research_unit_id", "$joinResearchUnit.id");
            $query->byAdministrativeUnit($params['administrative_unit_id']);
        }

        if (isset($params['phases']) && $params['phases']) {
            $joinPhases = 'intangible_asset_phases';
            $this->addJoin($joins, $joinPhases, "{$this->model->getTable()}.id", "{$joinPhases}.intangible_asset_id");
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

        $joins = $joins->unique();

        $joins->each(function ($item, $key) use ($query) {
            $item = json_decode($item, false);
            $query->join($key, $item->first, '=', $item->second, $item->join_type);
        });

        return $query;
    }
}
