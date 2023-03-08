<?php

namespace App\Services\Admin;

use App\Services\AbstractServiceModel;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Admin\IntellectualPropertyRightCategoryRepository;
use App\Repositories\Admin\IntellectualPropertyRightSubcategoryRepository;
use App\Repositories\Admin\IntellectualPropertyRightProductRepository;

class IntellectualPropertyRightCategoryService extends AbstractServiceModel
{
    /** @var IntellectualPropertyRightCategoryRepository */
    protected $intellectualPropertyRightCategoryRepository;

    /** @var IntellectualPropertyRightSubcategoryRepository */
    protected $intellectualPropertyRightSubcategoryRepository;

    /** @var IntellectualPropertyRightProductRepository */
    protected $intellectualPropertyRightProductRepository;

    public function __construct(
        IntellectualPropertyRightCategoryRepository $intellectualPropertyRightCategoryRepository,
        IntellectualPropertyRightSubcategoryRepository $intellectualPropertyRightSubcategoryRepository,
        IntellectualPropertyRightProductRepository $intellectualPropertyRightProductRepository,
    ) {

        $this->repository = $this->intellectualPropertyRightCategoryRepository = $intellectualPropertyRightCategoryRepository;
        $this->intellectualPropertyRightSubcategoryRepository = $intellectualPropertyRightSubcategoryRepository;
        $this->intellectualPropertyRightProductRepository = $intellectualPropertyRightProductRepository;
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

            $perPage = $this->intellectualPropertyRightCategoryRepository->getPerPage();
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
     * @param mixed $productId
     */
    public function getIntellectualPropertyCategorySelect($productId = null): array
    {
        /** Categories */
        $categories = $this->repository->all();

        if (!is_null($productId)) {
            /** @var \App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightProduct $product */
            $product = $this->intellectualPropertyRightProductRepository->getById($productId);

            /** @var \App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightSubcategory $subCategory */
            $subCategory = $this->intellectualPropertyRightSubcategoryRepository->getById($product->intellectual_property_right_subcategory_id);

            /** @var \App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightCategory $category */
            $category = $this->repository->getById($subCategory->intellectual_property_right_category_id);

            /** SubCategories */
            $subCategories = $this->intellectualPropertyRightSubcategoryRepository->getByIntellectualPropertyRightCategory($category);

            /** Products */
            $products = $this->intellectualPropertyRightProductRepository->getByIntellectualPropertyRightSubcategory($subCategory);
        } else {

            /** @var \App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightCategory $category */
            $category = $categories->first();

            /** SubCategories */
            $subCategories = $this->intellectualPropertyRightSubcategoryRepository->getByIntellectualPropertyRightCategory($category);

            /** @var \App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightSubcategory $subCategory */
            $subCategory = $subCategories->first();

            /** Products */
            $products = $this->intellectualPropertyRightProductRepository->getByIntellectualPropertyRightSubcategory($subCategories->first());

            /** @var \App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightProduct $product */
            $product = $products->first();
        }

        $categories = $categories->pluck('name', 'id')->prepend('Seleccionar Categoría', -1);

        $subCategories = $subCategories->pluck('name', 'id')->prepend('Seleccionar Subategoría', -1);

        $products = $products->pluck('name', 'id')->prepend('Seleccionar Producto', -1);

        return [$categories, $subCategories, $products, $category, $subCategory, $product];
    }
}
