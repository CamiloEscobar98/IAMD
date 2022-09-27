<?php

namespace App\Repositories\Admin;

use App\Repositories\AbstractRepository;

use App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightSubcategory;

class IntellectualPropertyRightSubcategoryRepository extends AbstractRepository
{
    public function __construct(IntellectualPropertyRightSubcategory $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * @param array $with
     * @param array $withCount
     * @param int $state_id
     * 
     * @return mixed
     */
    public function search(array $params = [], array $with = [], array $withCount = [])
    {
        $query = $this->model
            ->select();

        if (isset($params['id']) && $params['id']) {
            $query->ofId($params['id']);
        }

        if (isset($params['category_id']) && $params['category_id']) {
            $query->ofCategory($params['category_id']);
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

        return $query;
    }

    /**
     * @param \App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightCategory $category
     */
    public function getIntellectualPropertyRightCategory($category)
    {
        return  $this->model->ofCategory($category->id)->get();
    }
}
