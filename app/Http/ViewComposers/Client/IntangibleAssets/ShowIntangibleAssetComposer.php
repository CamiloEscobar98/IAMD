<?php

namespace App\Http\ViewComposers\Client\IntangibleAssets;

use Illuminate\View\View;

use App\Services\Admin\IntellectualPropertyRightCategoryService;
use App\Repositories\Admin\IntangibleAssetStateRepository;
use App\Repositories\Admin\IntellectualPropertyRightSubcategoryRepository;

use App\Repositories\Client\IntangibleAssetRepository;
use App\Repositories\Client\CreatorRepository;
use App\Repositories\Client\SecretProtectionMeasureRepository;
use App\Repositories\Client\PriorityToolRepository;

class ShowIntangibleAssetComposer
{
    /** @var IntellectualPropertyRightCategoryService */
    protected $intellectualPropertyRightCategoryService;

    /** @var IntellectualPropertyRightSubcategoryRepository */
    protected $intellectualPropertyRightSubcategoryRepository;

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

        IntellectualPropertyRightSubcategoryRepository $intellectualPropertyRightSubcategoryRepository,

        IntangibleAssetRepository $intangibleAssetRepository,
        IntangibleAssetStateRepository $intangibleAssetStateRepository,

        CreatorRepository $creatorRepository,
        SecretProtectionMeasureRepository $secretProtectionMeasureRepository,
        PriorityToolRepository $priorityToolRepository,
    ) {
        $this->intellectualPropertyRightCategoryService = $intellectualPropertyRightCategoryService;

        $this->intellectualPropertyRightSubcategoryRepository = $intellectualPropertyRightSubcategoryRepository;

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
        $dpis = $this->intellectualPropertyRightSubcategoryRepository->search(['category_id' => $category->id])->get();

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
