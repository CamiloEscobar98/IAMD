<?php

namespace App\Services\Client;

use App\Services\AbstractServiceModel;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Client\RoleRepository;
use Illuminate\Support\Facades\DB;

class RoleService extends AbstractServiceModel
{
    /** @var RoleRepository */
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->repository = $this->roleRepository = $roleRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data 
     * @return RedirectResponse
     */
    public function save(array $data): array
    {
        $dataCollection = collect($data);
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            $dataInput = $dataCollection->all();
            DB::beginTransaction();
            /** @var \App\Models\Client\Role $item */
            $item = $this->roleRepository->create($dataInput);
            $permissions = $dataCollection->get('permissions');
            $item->syncPermissions($permissions);
            DB::commit();
        } catch (\Exception $th) {
            DB::rollBack();
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @param  int  $id
     * @return View|RedirectResponse
     */
    public function update(array $data, $id): array
    {
        $dataCollection = collect($data);
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            $data = $dataCollection->all();
            DB::beginTransaction();
            $item = $this->roleRepository->getById($id);
            $this->roleRepository->update($item, $data);
            $permissions = $dataCollection->get('permissions');
            $item->syncPermissions($permissions);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.delete-success')];
        } catch (\Exception $th) {
            DB::rollBack();
        }
        return $response;
    }

    /**
     * @param array $params
     * 
     * @return mixed
     */
    public function transformParams($params)
    {
        if (empty($params)) {
            // $params = set_sub_month_date_filter($params, 'date_from', 1);
        }

        # Clean empty keys
        $params = array_filter($params);

        return $params;
    }

    /**
     * @param $query
     * @param array $params
     * @param int $pageNumber
     * @param int $total
     * 
     * @return LengthAwarePaginator $items
     */
    public function customPagination($query, $params, $pageNumber, $total)
    {
        try {

            $perPage = $this->roleRepository->getPerPage();
            $pageName = 'page';
            $offset = ($pageNumber -  1) * $perPage;

            $page = Paginator::resolveCurrentPage($pageName);

            $query->skip($offset)
                ->take($perPage);

            if (isset($params['order_by'])) {
                if ($params['order_by'] == 1) {
                    $query->orderBy('name', 'ASC');
                } else {
                    $query->orderBy('name', 'DESC');
                }
            } else {
                $query->orderBy('name', 'ASC');
            }
            $items = $query->get();

            $items = new LengthAwarePaginator($items, $total, $perPage, $page, [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => $pageName
            ]);

            $items->appends($params);

            return $items;
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * Search Roles with a Pagination.
     * @param array $data
     * @param int $page
     * @param array $with
     * @param array $withCount
     */
    public function searchWithPagination(array $data, int $page = null, array $with = [], $withCount = []): array
    {
        $params = $this->transformParams($data);
        $query = $this->roleRepository->search($params, $with, $withCount);
        $total = $query->count();
        $items = $this->customPagination($query, $params, $page, $total);
        $links = $items->links('pagination.customized');

        return [$params, $total, $items, $links];
    }
}
