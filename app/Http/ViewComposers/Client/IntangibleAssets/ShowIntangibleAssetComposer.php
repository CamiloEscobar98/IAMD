<?php

namespace App\Http\ViewComposers\Client\IntangibleAssets;

use Illuminate\View\View;

use App\Repositories\Admin\IntangibleAssetStateRepository;
use App\Repositories\Admin\IntellectualPropertyRightCategoryRepository;
use App\Repositories\Admin\IntellectualPropertyRightSubcategoryRepository;
use App\Repositories\Admin\IntellectualPropertyRightProductRepository;

use App\Repositories\Client\IntangibleAssetRepository;
use App\Repositories\Client\CreatorRepository;
use App\Repositories\Client\SecretProtectionMeasureRepository;
use App\Repositories\Client\PriorityToolRepository;
use App\Services\Admin\IntellectualPropertyRightCategoryService;

class ShowIntangibleAssetComposer
{
    /** @var IntellectualPropertyRightCategoryService */
    protected $intellectualPropertyRightCategoryService;

    /** @var IntellectualPropertyRightCategoryRepository */
    protected $intellectualPropertyRightCategoryRepository;

    /** @var IntellectualPropertyRightSubcategoryRepository */
    protected $intellectualPropertyRightSubcategoryRepository;

    /** @var IntellectualPropertyRightProductRepository */
    protected $intellectualPropertyRightProductRepository;

    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    /** @var IntangibleAssetStateRepository */
    protected $intangibleAssetStateRepository;

    /** @var CreatorRepository */
    protected $creatorRepository;

    /** @var SecretProtectionMeasureRepository */
    protected $secretProtectionMeasureRepository;

    /** @var PriorityToolRepository */
    protected $priorityToolRepository;

    public function __construct(
        IntellectualPropertyRightCategoryService $intellectualPropertyRightCategoryService,

        IntellectualPropertyRightCategoryRepository $intellectualPropertyRightCategoryRepository,
        IntellectualPropertyRightSubcategoryRepository $intellectualPropertyRightSubcategoryRepository,
        IntellectualPropertyRightProductRepository $intellectualPropertyRightProductRepository,

        IntangibleAssetRepository $intangibleAssetRepository,
        IntangibleAssetStateRepository $intangibleAssetStateRepository,

        CreatorRepository $creatorRepository,
        SecretProtectionMeasureRepository $secretProtectionMeasureRepository,
        PriorityToolRepository $priorityToolRepository,
    ) {
        $this->intellectualPropertyRightCategoryService = $intellectualPropertyRightCategoryService;

        $this->intellectualPropertyRightCategoryRepository = $intellectualPropertyRightCategoryRepository;
        $this->intellectualPropertyRightSubcategoryRepository = $intellectualPropertyRightSubcategoryRepository;
        $this->intellectualPropertyRightProductRepository = $intellectualPropertyRightProductRepository;

        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;

        $this->creatorRepository = $creatorRepository;
        $this->secretProtectionMeasureRepository = $secretProtectionMeasureRepository;
        $this->priorityToolRepository = $priorityToolRepository;
    }

    public function compose(View $view)
    {
        $intangibleAssetId = request()->intangible_asset;

        /** @var \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset */
        $intangibleAsset = $this->intangibleAssetRepository->getById($intangibleAssetId);

        if ($intangibleAsset->hasPhaseOneCompleted()) {
            [$categories, $subCategories, $products, $category, $subCategory, $product] = $this->intellectualPropertyRightCategoryService->getIntellectualPropertyCategorySelect($intangibleAsset->classification_id);
        } else {
            [$categories, $subCategories, $products, $category, $subCategory, $product] = $this->intellectualPropertyRightCategoryService->getIntellectualPropertyCategorySelect();
        }

        /** States */
        $states = $this->intangibleAssetStateRepository->all();

        /** DPIS */
        $dpis = $this->intellectualPropertyRightSubcategoryRepository->all();

        $informationScopes = collect([1 => 'Premilinar', 2 => 'Parcial', 3 => 'Total']);

        $creators = $this->creatorRepository->all();

        $secretProtectionMeasures = $this->secretProtectionMeasureRepository->all();

        $priorityTools = $this->priorityToolRepository->all();

        $categories = $categories->pluck('name', 'id')->prepend('Seleccionar Categoría', -1);

        $subCategories = $subCategories->pluck('name', 'id')->prepend('Seleccionar Subategoría', -1);

        $products = $products->pluck('name', 'id')->prepend('Seleccionar Producto', -1);

        $view->with(compact(
            'categories',
            'subCategories',
            'products',

            'category',
            'subCategory',
            'product',

            'states',
            'dpis',

            'informationScopes',

            'creators',
            'secretProtectionMeasures',
            'priorityTools'
        ));
    }
}
