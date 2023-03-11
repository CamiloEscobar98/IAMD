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
     * @return \App\Models\Client\Role
     */
    public function save(array $data)
    {
        $dataCollection = collect($data);
        $dataInput = $dataCollection->all();
        /** @var \App\Models\Client\Role $item */
        $item = $this->roleRepository->create($dataInput);
        $permissions = $dataCollection->get('permissions');
        $item->syncPermissions($permissions);
        return $item;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @param  int  $id
     * @return \App\Models\Client\Role
     */
    public function update(array $data, $id)
    {
        $dataCollection = collect($data);
        $data = $dataCollection->all();
        $item = $this->roleRepository->getById($id);
        $this->roleRepository->update($item, $data);
        $permissions = $dataCollection->get('permissions');
        $item->syncPermissions($permissions);
        return $item;
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
}
