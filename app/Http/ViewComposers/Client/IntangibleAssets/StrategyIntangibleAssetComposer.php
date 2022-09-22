<?php

namespace App\Http\ViewComposers\Client\IntangibleAssets;

use Illuminate\View\View;

use App\Repositories\Client\IntangibleAssetRepository;
use App\Repositories\Client\StrategyCategoryRepository;
use App\Repositories\Client\StrategyRepository;
use App\Repositories\Client\UserRepository;

class StrategyIntangibleAssetComposer
{
    /** @var StrategyCategoryRepository */
    protected $strategyCategoryRepository;

    /** @var StrategyRepository */
    protected $strategyRepository;

    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    /** @var UserRepository */
    protected $userRepository;

    public function __construct(
        StrategyCategoryRepository $strategyCategoryRepository,
        StrategyRepository $strategyRepository,
        IntangibleAssetRepository $intangibleAssetRepository,
        UserRepository $userRepository
    ) {
        $this->strategyCategoryRepository = $strategyCategoryRepository;
        $this->strategyRepository = $strategyRepository;
        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->userRepository = $userRepository;
    }

    public function compose(View $view)
    {
        $intangibleAssetId = request()->intangible_asset;

        /** @var \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset */
        $intangibleAsset = $this->intangibleAssetRepository->getById($intangibleAssetId);

        /** StrategyCategories */
        $strategyCategories = $this->strategyCategoryRepository->all();

        /** Strategies */
        $strategies = $this->strategyRepository->all();

        /** Users */
        $users = $this->userRepository->all();

        return $view->with(compact('strategyCategories', 'strategies', 'users'));
    }
}
