<?php

namespace App\Services\Client;

use App\Services\AbstractServiceModel;

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
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function save($arrayData)
    {
        $data = collect($arrayData);
        $userData = $data->only('name', 'email', 'password');
      
        /** @var \App\Models\Client\User $item */
        $item = $this->userRepository->create($userData->toArray());
        $role = $data->get('role_id');
        $item->assignRole($role);
        return $item;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param array $arrayData
     * @param mixed  $id
     * @return \App\Models\Client\User
     */
    public function update(array $arrayData, $id)
    {
        $data = collect($arrayData);
        $role = $data->get('role_id');

        $attributesRequest = is_null($data->get('password')) ? ['name', 'email', 'role_id'] : ['name', 'email', 'role_id', 'password'];

        $data = $data->only($attributesRequest);

        $item = $this->userRepository->getById($id);

        $this->userRepository->update($item, $data->toArray());


        /** @var \App\Models\Client\User $item */
        $item->syncRoles($role);
        return $item;
    }

    /**
     * @param array $params
     * 
     * @return array<string,string>
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
}
