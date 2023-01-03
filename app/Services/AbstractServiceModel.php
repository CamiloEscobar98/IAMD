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
     * @return array
     */
    public function save(array $data): array
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            DB::beginTransaction();
            $this->repository->create($data);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
        } catch (QueryException $th) {
            dd($th->getMessage());
            DB::rollBack();
        }
        return $response;
    }

    /**
     * Update a resource.
     * 
     * @param array $data
     * @param int $documentTypeId
     * @return array
     */
    public function update(array $data, int $documentTypeId): array
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            DB::beginTransaction();
            $item = $this->repository->getById($documentTypeId);
            $this->repository->update($item, $data);
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
            DB::commit();
        } catch (QueryException $th) {
            DB::rollBack();
        }
        return $response;
    }

    /**
     * Delete a resource.
     * @param int $documentTypeId
     * @return array
     */
    public function delete(int $documentTypeId): array
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.delete-error')];

        try {
            DB::beginTransaction();
            $item = $this->repository->getById($documentTypeId);
            $this->repository->delete($item);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
        } catch (QueryException $th) {
            DB::rollBack();
        }
        return $response;
    }
}
