<?php

namespace App\Repositories\Admin;

use App\Repositories\AbstractRepository;

use App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightProduct;

class IntellectualPropertyRightProductRepository extends AbstractRepository
{
    public function __construct(IntellectualPropertyRightProduct $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * @param array $with
     * @param array $withCount
     * @param int $state_id
     * 
     * @return \Illuminate\Database\Query\Builder
     */
    public function search(array $params = [], array $with = [], array $withCount = [])
    {
        $joins = collect();

        $joinIntellectualPropertyRightCategory = 'intellectual_property_right_categories';
        $joinIntellectualPropertyRightSubcategory = 'intellectual_property_right_subcategories';

        $query = $this->model
            ->select("{$this->model->getTable()}.*");

        if (isset($params['id']) && $params['id']) {
            $query->ofId($params['id']);
        }

        if (isset($params['intellectual_property_right_category_id']) && $params['intellectual_property_right_category_id'] > 0) {
            $this->addJoin($joins, $joinIntellectualPropertyRightSubcategory, "{$joinIntellectualPropertyRightSubcategory}.id", "{$this->model->getTable()}.intellectual_property_right_subcategory_id");
            $this->addJoin($joins, $joinIntellectualPropertyRightCategory, "{$joinIntellectualPropertyRightCategory}.id", "{$joinIntellectualPropertyRightSubcategory}.intellectual_property_right_category_id");
            $query->ofCategory($params['intellectual_property_right_category_id']);
        }


        if (isset($params['intellectual_property_right_subcategory_id']) && $params['intellectual_property_right_subcategory_id'] > 0) {
            $query->ofSubcategory($params['intellectual_property_right_subcategory_id']);
        }

        if (isset($params['name']) && $params['name']) {
            $query->ofNameLike($params['name']);
        }

        if (isset($params['date_from']) && $params['date_from']) {
            $query->ofDateFrom($params['date_from']);
        }

        if (isset($params['date_to']) && $params['date_to']) {
            $query->ofDateTo($params['date_to']);
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

       /**
     * @param array $params
     * @param array $with
     * @param array $withCount
     * @param int $state_id
     * 
     * @return \Illuminate\Database\Query\Builder
     */
    public function searchForReport(array $params = [], array $with = [], array $withCount = [])
    {
        $joins = collect();

        $joinIntellectualPropertyRightCategory = 'intellectual_property_right_categories';
        $joinIntellectualPropertyRightSubcategory = 'intellectual_property_right_subcategories';

        $query = $this->model
            ->select(["{$this->model->getTable()}.*", "$joinIntellectualPropertyRightSubcategory.intellectual_property_right_category_id"]);

        if (isset($params['id']) && $params['id']) {
            $query->ofId($params['id']);
        }

        if (isset($params['intellectual_property_right_category_id']) && $params['intellectual_property_right_category_id'] > 0) {
            $this->addJoin($joins, $joinIntellectualPropertyRightSubcategory, "{$joinIntellectualPropertyRightSubcategory}.id", "{$this->model->getTable()}.intellectual_property_right_subcategory_id");
            $this->addJoin($joins, $joinIntellectualPropertyRightCategory, "{$joinIntellectualPropertyRightCategory}.id", "{$joinIntellectualPropertyRightSubcategory}.intellectual_property_right_category_id");
            $query->ofCategory($params['intellectual_property_right_category_id']);
        }


        if (isset($params['intellectual_property_right_subcategory_id']) && $params['intellectual_property_right_subcategory_id'] > 0) {
            $query->ofSubcategory($params['intellectual_property_right_subcategory_id']);
        }

        if (isset($params['name']) && $params['name']) {
            $query->ofNameLike($params['name']);
        }

        if (isset($params['date_from']) && $params['date_from']) {
            $query->ofDateFrom($params['date_from']);
        }

        if (isset($params['date_to']) && $params['date_to']) {
            $query->ofDateTo($params['date_to']);
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

    /**
     * @param \App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightSubcategory $subCategory
     */
    public function getByIntellectualPropertyRightSubcategory($subCategory)
    {
        return $this->model->ofSubcategory($subCategory->id)->get();
    }
}
