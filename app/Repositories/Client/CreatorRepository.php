<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use Illuminate\Database\Eloquent\Collection;

use App\Models\Client\Creator\Creator;

class CreatorRepository extends AbstractRepository
{
    public function __construct(Creator $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function getAllCreators(): Collection
    {
        $table = $this->model->getTable();

        $joinCreatorInternal = "creator_internals";
        $joinCreatorExternal = "creator_externals";

        $query = $this->model
            ->select()
            ->distinct()
            ->leftJoin($joinCreatorInternal, "$table.id", "$joinCreatorInternal.creator_id")
            ->leftJoin($joinCreatorExternal, "$table.id", "$joinCreatorExternal.creator_id");

        return $query->get();
    }

    /**
     * @return Collection
     */
    public function getDirectors(): Collection
    {
        $table = $this->model->getTable();

        $joinResearchUnit = "research_units";

        $query = $this->model
            ->select("{$table}.*")
            ->distinct()
            ->join($joinResearchUnit, "{$joinResearchUnit}.director_id", "{$table}.id");

        return $query->get();
    }

    /**
     * @return Collection
     */
    public function getInventoryManagers(): Collection
    {
        $table = $this->model->getTable();

        $joinResearchUnit = "research_units";

        $query = $this->model
            ->select("{$table}.*")
            ->distinct()
            ->join($joinResearchUnit, "{$joinResearchUnit}.inventory_manager_id", "{$table}.id");

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
