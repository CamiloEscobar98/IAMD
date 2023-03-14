<?php

namespace App\Repositories\Admin;

use App\Repositories\AbstractRepository;

use App\Models\Admin\AssignmentContract;

class AssignmentContractRepository extends  AbstractRepository
{
    public function __construct(AssignmentContract $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * 
     * @return \Illuminate\Database\Query\Builder
     */
    public function search($params)
    {
        $query = $this->model
            ->select();

        if (isset($params['name']) && $params['name']) {
            $query->where('name', 'like', '%' . $params['name'] . '%');
        }

        if (isset($params['type']) && $params['type']) {
            switch ($params['type']) {
                case 1:
                    $query->where('is_internal', true);
                    break;

                case 2:
                    $query->where('is_internal', false);
                    break;
            }
        }

        if (isset($params['date_from']) && $params['date_from']) {
            $query->where('updated_at', '>=', $params['date_from']);
        }

        if (isset($params['date_to']) && $params['date_to']) {
            $query->where('updated_at', '<=', $params['date_to']);
        }

        return $query;
    }
}
