<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

use App\Repositories\AbstractRepository;

abstract class AbstractServiceModel
{
    /** @var AbstractRepository */
    protected $repository;

    /**
     * Store a new resource.
     * 
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function save(array $data)
    {
        return $this->repository->create($data);
    }

    /**
     * Update a resource.
     * 
     * @param array $data
     * @param mixed $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(array $data, mixed $id)
    {
        $item = $this->repository->getById($id);
        $this->repository->update($item, $data);
        return $item;
    }

    /**
     * Delete a resource.
     * 
     * @param mixed $id
     */
    public function delete(mixed $id)
    {
        $item = $this->repository->getById($id);
        $this->repository->delete($item);
    }
}
