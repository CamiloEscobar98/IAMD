<?php

namespace App\Repositories;

use App\Models\ExternalOrganization;

class ExternalOrganizationRepository extends  AbstractRepository
{
    public function __construct(ExternalOrganization $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * 
     * @return mixed
     */
    public function search($params)
    {
        $query = $this->model
            ->select();

        if (isset($params['nit']) && $params['nit']) {
            $query->where('nit', 'like', '%' . $params['nit'] . '%');
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

        return $query;
    }
}
