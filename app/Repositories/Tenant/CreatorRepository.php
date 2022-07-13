<?php

namespace App\Repositories\Tenant;

use App\Repositories\AbstractRepository;

use App\Models\Tenant\Creator;

class CreatorRepository extends AbstractRepository
{
    public function __construct(Creator $model)
    {
        $this->model = $model;
    }

    /**
     * Create Document information.
     * 
     * @param array $params
     * 
     * @return \App\MOdels\Tenant\CreatorDocument
     */
    public function addDocument($params)
    {
        return $this->model->document->create($params);
    }

    /**
     * Update Document Information
     * 
     * @param array $params
     * 
     * @return \App\MOdels\Tenant\CreatorDocument
     */
    public function updateDocument($params)
    {
        return $this->model->document->update($params);
    }
}
