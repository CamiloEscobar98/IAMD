<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\Creator\Creator;

class CreatorRepository extends AbstractRepository
{
    public function __construct(Creator $model)
    {
        $this->model = $model;
    }

    public function allCreators()
    {
        $table = $this->model->getTable();

        $joinCreatorInternal = "creator_internals";
        $joinCreatorExternal = "creator_externals";

        $query = $this->model
            ->select()
            ->distinct()
            ->leftJoin( $joinCreatorInternal, "$table.id", "$joinCreatorInternal.creator_id")
            ->leftJoin( $joinCreatorExternal, "$table.id", "$joinCreatorExternal.creator_id");

            return $query->get();
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
