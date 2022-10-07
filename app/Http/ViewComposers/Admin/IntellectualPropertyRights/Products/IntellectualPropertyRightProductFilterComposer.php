<?php

namespace App\Http\ViewComposers\Admin\IntellectualPropertyRights\Products;

use Illuminate\View\View;

use App\Repositories\Admin\IntellectualPropertyRightCategoryRepository;
use App\Repositories\Admin\IntellectualPropertyRightProductRepository;
use App\Repositories\Admin\IntellectualPropertyRightSubcategoryRepository;

class IntellectualPropertyRightProductFilterComposer
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
        IntellectualPropertyRightProductRepository $intellectualPropertyRightProductRepository
    ) {
        $this->intellectualPropertyRightCategoryRepository = $intellectualPropertyRightCategoryRepository;
        $this->intellectualPropertyRightSubcategoryRepository = $intellectualPropertyRightSubcategoryRepository;
        $this->intellectualPropertyRightProductRepository = $intellectualPropertyRightProductRepository;
    }

    public function compose(View $view)
    {
        $intellectualPropertyRightProductId = request()->product;

        $categories = $this->intellectualPropertyRightCategoryRepository->all();

        if ($intellectualPropertyRightProductId) {

            /** Product */
            $product = $this->intellectualPropertyRightProductRepository->getById($intellectualPropertyRightProductId);

            /** Subcategory */
            $subcategory = $this->intellectualPropertyRightSubcategoryRepository->getById($product->intellectual_property_right_subcategory_id);

            /** Category */
            $category = $this->intellectualPropertyRightCategoryRepository->getById($subcategory->intellectual_property_right_category_id);

            /** Subcategories */
            $subcategories = $this->intellectualPropertyRightSubcategoryRepository->getByIntellectualPropertyRightCategory($category);
        }

        /** Category */
        $category = $categories->first();

        /** Subcategories */
        $subcategories = $this->intellectualPropertyRightSubcategoryRepository->getByIntellectualPropertyRightCategory($category);

        /** Subcategory */
        $subcategory = $subcategories->first();

        $categories = $categories->pluck('name', 'id')->prepend('Seleccionar Categoría', -1);

        $subcategories = $subcategories->pluck('name', 'id')->prepend('Seleccionar Subategoría', -1);

        $view->with(compact('categories', 'subcategories', 'category', 'subcategory'));
    }
}
