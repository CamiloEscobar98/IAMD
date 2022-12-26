<?php

namespace App\Services\Admin;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Admin\StateRepository;

class StateService
{
    /** @var StateRepository */
    protected $stateRepository;

    public function __construct(StateRepository $stateRepository)
    {
        $this->stateRepository = $stateRepository;
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
        if (isset($params['country']) && $params['country']) {
            $params['country_id'] = $params['country'];

            $params['country'] = null;
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

            $perPage = isset($perPage) && $perPage ? $perPage : $this->stateRepository->getPerPage();
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
            $query->orderBy('country_id', 'ASC');
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
     * @param int|null $countryId
     */
    public function searchWithPagination(array $data, int $page, array $with = [], $withCount = [], int|null $countryId): array
    {
        $params = $this->transformParams($data);
        $query = $this->stateRepository->search($params, $with, $withCount, $countryId);
        $total = $query->count();
        $items = $this->customPagination($query, $params, 10, $page, $total);
        $links = $items->links('pagination.customized');

        return [$total, $items, $links];
    }
}
