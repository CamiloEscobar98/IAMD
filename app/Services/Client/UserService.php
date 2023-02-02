<?php

namespace App\Services\Client;

use App\Services\AbstractServiceModel;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Client\UserRepository;

class UserService extends AbstractServiceModel
{
    /** @var UserRepository */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $this->userRepository = $userRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $arrayData
     * @return array
     */
    public function save($arrayData): array
    {
        $data = collect($arrayData);
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            $userData = $data->only('name', 'email', 'password');
            DB::beginTransaction();
            /** @var \App\Models\Client\User $item */
            $item = $this->userRepository->create($userData->toArray());
            $role = $data->get('role_id');
            $item->assignRole($role);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
        } catch (QueryException $th) {
            DB::rollBack();
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param array $arrayData
     * @param mixed  $id
     * @return array
     */
    public function update(array $arrayData, $id): array
    {
        $data = collect($arrayData);
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            $attributesRequest = is_null($data->get('password')) ? ['name', 'email', 'role_id'] : ['name', 'email', 'role_id', 'password'];

            $data = $data->only($attributesRequest);

            $item = $this->userRepository->getById($id);

            DB::beginTransaction();

            $this->userRepository->update($item, $data->toArray());

            $role = $data->get('role_id');

            /** @var \App\Models\Client\User $item */
            $item->syncRoles($role);

            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.update-success')];
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

            $perPage = $this->userRepository->getPerPage();
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
     * Search Users with a Pagination.
     * @param array $data
     * @param int $page
     * @param array $with
     * @param array $withCount
     */
    public function searchWithPagination(array $data, int $page = null, array $with = [], $withCount = []): array
    {
        $params = $this->transformParams($data);
        $query = $this->userRepository->search($params, $with, $withCount);
        $total = $query->count();
        $items = $this->customPagination($query, $params, $page, $total);
        $links = $items->links('pagination.customized');

        return [$params, $total, $items, $links];
    }
}
