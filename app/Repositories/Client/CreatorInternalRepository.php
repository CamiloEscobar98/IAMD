<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\Creator\CreatorInternal;

class CreatorInternalRepository extends  AbstractRepository
{
    public function __construct(CreatorInternal $model)
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
        $joinCreators = 'creators';
        $joinCreatorDocuments = 'creator_documents';

        $query = $this->model
            ->select()
            ->distinct()
            ->join("$joinCreators", "$table.creator_id", "$joinCreators.id")
            ->join("$joinCreatorDocuments", "$joinCreators.id", "$joinCreatorDocuments.creator_id");

        if (isset($params['document']) && $params['document']) {
            $query->where('document', $params['document']);
        }

        if (isset($params['id']) && $params['id']) {
            $query->where('creator_id', $params['id']);
        }

        if (isset($params['name']) && $params['name']) {
            $query->where("$joinCreators.name", 'like', '%' . $params['name'] . '%');
        }

        if (isset($params['linkage_type_id']) && $params['linkage_type_id']) {
            $query->where('linkage_type_id', $params['linkage_type_id']);
        }

        if (isset($params['assignment_contract_id']) && $params['assignment_contract_id']) {
            $query->where('assignment_contract_id', $params['assignment_contract_id']);
        }

        if (isset($params['date_from']) && $params['date_from']) {
            $query->where("$table.updated_at", '>=', $params['date_from']);
        }

        if (isset($params['date_to']) && $params['date_to']) {
            $query->where("$table.updated_at", '<=', $params['date_to']);
        }

        if (isset($with) && $with) {
            $query->with($with);
        }

        if (isset($withCount) && $withCount) {
            $query->withCount($withCount);
        }

        return $query;
    }
}
