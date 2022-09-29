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

class ShowIntangibleAssetComposer
{
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
        IntellectualPropertyRightCategoryRepository $intellectualPropertyRightCategoryRepository,
        IntellectualPropertyRightSubcategoryRepository $intellectualPropertyRightSubcategoryRepository,
        IntellectualPropertyRightProductRepository $intellectualPropertyRightProductRepository,

        IntangibleAssetRepository $intangibleAssetRepository,
        IntangibleAssetStateRepository $intangibleAssetStateRepository,

        CreatorRepository $creatorRepository,
        SecretProtectionMeasureRepository $secretProtectionMeasureRepository,
        PriorityToolRepository $priorityToolRepository,
    ) {
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

        /** Categories */
        $categories = $this->intellectualPropertyRightCategoryRepository->all();

        if ($intangibleAsset->hasPhaseOneCompleted()) {

            /** @var \App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightProduct $product */
            $product = $this->intellectualPropertyRightProductRepository->getById($intangibleAsset->classification_id);


            /** @var \App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightSubcategory $subCategory */
            $subCategory = $this->intellectualPropertyRightSubcategoryRepository->getById($product->intellectual_property_right_subcategory_id);

            /** @var \App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightCategory $category */
            $category = $this->intellectualPropertyRightCategoryRepository->getById($subCategory->intellectual_property_right_category_id);

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

        /** States */
        $states = $this->intangibleAssetStateRepository->all();

        /** DPIS */
        $dpis = $this->intellectualPropertyRightSubcategoryRepository->all();

        $informationScopes = collect([1 => 'Premilinar', 2 => 'Parcial', 3 => 'Total']);

        $creators = $this->creatorRepository->all();

        $secretProtectionMeasures = $this->secretProtectionMeasureRepository->all();

        $priorityTools = $this->priorityToolRepository->all();

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
