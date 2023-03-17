<?php

namespace App\Http\ViewComposers\Admin\IntellectualPropertyRights\Subcategories;

use Illuminate\View\View;

use App\Repositories\Admin\IntellectualPropertyRightCategoryRepository;

class IntellectualPropertyRightSubcategoryFormComposer
{
    /** @var IntellectualPropertyRightCategoryRepository */
    protected $intellectualPropertyRightCategoryRepository;

    public function __construct(IntellectualPropertyRightCategoryRepository $intellectualPropertyRightCategoryRepository)
    {
        $this->intellectualPropertyRightCategoryRepository = $intellectualPropertyRightCategoryRepository;
    }

    public function compose(View $view)
    {
        $categories = $this->intellectualPropertyRightCategoryRepository->all();

        $categories = $categories->pluck('name', 'id')->prepend('---Seleccionar Categoría', -1);

        $view->with(compact('categories'));
    }
}
