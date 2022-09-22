<?php

namespace App\Http\ViewComposers\Client\IntangibleAssets;

use Illuminate\View\View;

use App\Repositories\Admin\IntangibleAssetStateRepository;
use App\Repositories\Admin\IntangibleAssetTypeLevel1Repository;
use App\Repositories\Admin\IntangibleAssetTypeLevel2Repository;
use App\Repositories\Admin\IntangibleAssetTypeLevel3Repository;
use App\Repositories\Client\CreatorRepository;
use App\Repositories\Client\IntangibleAssetRepository;
use App\Repositories\Client\PriorityToolRepository;
use App\Repositories\Client\SecretProtectionMeasureRepository;

class ShowIntangibleAssetComposer
{
    /** @var IntangibleAssetTypeLevel1Repository */
    protected $intangibleAssetTypeLevel1Repository;

    /** @var IntangibleAssetTypeLevel2Repository */
    protected $intangibleAssetTypeLevel2Repository;

    /** @var IntangibleAssetTypeLevel3Repository */
    protected $intangibleAssetTypeLevel3Repository;

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
        IntangibleAssetTypeLevel1Repository $intangibleAssetTypeLevel1Repository,
        IntangibleAssetTypeLevel2Repository $intangibleAssetTypeLevel2Repository,
        IntangibleAssetTypeLevel3Repository $intangibleAssetTypeLevel3Repository,

        IntangibleAssetRepository $intangibleAssetRepository,
        IntangibleAssetStateRepository $intangibleAssetStateRepository,

        CreatorRepository $creatorRepository,
        SecretProtectionMeasureRepository $secretProtectionMeasureRepository,
        PriorityToolRepository $priorityToolRepository,
    ) {
        $this->intangibleAssetTypeLevel1Repository = $intangibleAssetTypeLevel1Repository;
        $this->intangibleAssetTypeLevel2Repository = $intangibleAssetTypeLevel2Repository;
        $this->intangibleAssetTypeLevel3Repository = $intangibleAssetTypeLevel3Repository;

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
        $categories = $this->intangibleAssetTypeLevel1Repository->all();

        if ($intangibleAsset->hasPhaseOneCompleted()) {

            /** @var \App\Models\Admin\IntangibleAssetTypeLevel\IntangibleAssetTypeLevel3 $product */
            $product = $this->intangibleAssetTypeLevel3Repository->getById($intangibleAsset->classification_id);


            /** @var \App\Models\Admin\IntangibleAssetTypeLevel\IntangibleAssetTypeLevel2 $subCategory */
            $subCategory = $this->intangibleAssetTypeLevel2Repository->getById($product->intangible_asset_type_level2_id);

            /** @var \App\Models\Admin\IntangibleAssetTypeLevel\IntangibleAssetTypeLevel1 $category */
            $category = $this->intangibleAssetTypeLevel1Repository->getById($subCategory->intangible_asset_type_level1_id);

            /** SubCategories */
            $subCategories = $this->intangibleAssetTypeLevel2Repository->getByIntangibleAssetTypeLevel1($category);

            /** Products */
            $products = $this->intangibleAssetTypeLevel3Repository->getByIntangibleAssetTypeLevel2($subCategory);
        } else {

            /** @var \App\Models\Admin\IntangibleAssetTypeLevel\IntangibleAssetTypeLevel1 $category */
            $category = $categories->first();

            /** SubCategories */
            $subCategories = $this->intangibleAssetTypeLevel2Repository->getByIntangibleAssetTypeLevel1($category);

            /** @var \App\Models\Admin\IntangibleAssetTypeLevel\IntangibleAssetTypeLevel2 $subCategory */
            $subCategory = $subCategories->first();

            /** Products */
            $products = $this->intangibleAssetTypeLevel3Repository->getByIntangibleAssetTypeLevel2($subCategories->first());

            /** @var \App\Models\Admin\IntangibleAssetTypeLevel\IntangibleAssetTypeLevel3 $product */
            $product = $products->first();
        }

        /** States */
        $states = $this->intangibleAssetStateRepository->all();

        /** DPIS */
        $dpis = $this->intangibleAssetTypeLevel2Repository->all();

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
