<?php

namespace App\Services\Admin;

use App\Services\AbstractServiceModel;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Admin\CityRepository;

class CityService extends AbstractServiceModel
{
    /** @var CityRepository */
    protected $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->repository = $this->cityRepository = $cityRepository;
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
