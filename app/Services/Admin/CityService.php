<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Admin\CityRepository;

class CityService
{
    /** @var CityRepository */
    protected $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * Store a new City.
     * 
     * @param array $data
     * @return array
     */
    public function save(array $data): array
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.cities.messages.save_error')];
        try {
            DB::beginTransaction();
            $item = $this->cityRepository->create($data);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.localizations.cities.messages.save_success', ['city' => $item->name])];
        } catch (QueryException $th) {
            DB::rollBack();
        }
        return $response;
    }

    /**
     * Update a City.
     * 
     * @param array $data
     * @param int $cityId
     * @return array
     */
    public function update(array $data, int $cityId): array
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.cities.messages.update_error')];
        try {
            DB::beginTransaction();
            $item = $this->cityRepository->getById($cityId);
            $this->cityRepository->update($item, $data);
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.localizations.cities.messages.update_success', ['city' => $item->name])];
            DB::commit();
        } catch (QueryException $th) {
            DB::rollBack();
        }
        return $response;
    }

    /**
     * Delete a City.
     * @param int $cityId
     * @return array
     */
    public function delete(int $cityId): array
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.cities.messages.delete_error')];

        try {
            DB::beginTransaction();
            $item = $this->cityRepository->getById($cityId);
            $this->cityRepository->delete($item);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.localizations.cities.messages.delete_success', ['city' => $item->name])];
        } catch (QueryException $th) {
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
            // // $params = set_sub_month_date_filter($params, 'date_from', 1);
        }
        if (isset($params['state']) && $params['state']) {
            $params['state_id'] = $params['state'];

            $params['state'] = null;
        }

        # Clean empty keys
        $params = array_filter($params);

        return $params;
    }

    /**
     * @param $query
     * @param array $params
     * @param int $perPage
     * @param int $pageNumber
     * @param int $total
     * 
     * @return LengthAwarePaginator $items
     */
    public function customPagination($query, $params, $perPage = null, $pageNumber, $total)
    {
        try {

            $perPage = isset($perPage) && $perPage ? $perPage : $this->cityRepository->getPerPage();
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
            $query->orderBy('state_id', 'ASC');
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
     * @param array $data
     * @param int $page
     * @param array $with
     * @param array $withCount
     * @param int|null $cityId
     */
    public function searchWithPagination(array $data, int $page = null, array $with = [], $withCount = [], int|null $cityId = null): array
    {
        $params = $this->transformParams($data);
        $query = $this->cityRepository->search($params, $with, $withCount, $cityId);
        $total = $query->count();
        $items = $this->customPagination($query, $params, 10, $page, $total);
        $links = $items->links('pagination.customized');

        return [$params, $total, $items, $links];
    }
}
