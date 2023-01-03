<?php

namespace App\Services\Admin;

use App\Services\AbstractServiceModel;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Admin\IntellectualPropertyRightSubcategoryRepository;

class IntellectualPropertyRightSubcategoryService extends AbstractServiceModel
{
    /** @var IntellectualPropertyRightSubcategoryRepository */
    protected $intellectualPropertyRightSubcategoryRepository;

    public function __construct(IntellectualPropertyRightSubcategoryRepository $intellectualPropertyRightSubcategoryRepository)
    {
        $this->repository = $this->intellectualPropertyRightSubcategoryRepository = $intellectualPropertyRightSubcategoryRepository;
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

            $perPage = $this->intellectualPropertyRightSubcategoryRepository->getPerPage();
            $pageName = 'page';
            $offset = ($pageNumber -  1) * $perPage;

            $page = Paginator::resolveCurrentPage($pageName);

            $query->skip($offset)
                ->take($perPage);

            $query->orderBy('intellectual_property_right_category_id', 'ASC');

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
     */
    public function searchWithPagination(array $data, int $page = null, array $with = [], $withCount = []): array
    {
        $params = $this->transformParams($data);
        $query = $this->intellectualPropertyRightSubcategoryRepository->search($params, $with, $withCount);
        $total = $query->count();
        $items = $this->customPagination($query, $params, $page, $total);
        $links = $items->links('pagination.customized');

        return [$params, $total, $items, $links];
    }
}
