<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Client\IntangibleAssetPhaseRepository;
use App\Repositories\Client\IntangibleAssetRepository;
use App\Repositories\Client\StrategyCategoryRepository;
use Illuminate\Http\Request;


class IntangibleAssetStrategyController extends Controller
{
    /** @var StrategyCategoryRepository */
    protected $strategyCategoryRepository;

    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    /** @var IntangibleAssetPhaseRepository */
    protected $intangibleAssetPhaseRepository;

    public function __construct(
        StrategyCategoryRepository $strategyCategoryRepository,

        IntangibleAssetRepository $intangibleAssetRepository,
        IntangibleAssetPhaseRepository $intangibleAssetPhaseRepository,
    ) {
        $this->strategyCategoryRepository = $strategyCategoryRepository;

        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->intangibleAssetPhaseRepository = $intangibleAssetPhaseRepository;
    }

    public function updateHasStrategies($id, $intangibleAsset, Request $request)
    {
        $request->validate(['has_strategies' => ['required']]);

        $hasStrategiesOption = $request->get('has_strategies');

        try {
            /** @var \App\Models\Client\IntangibleAsset\IntangibleAsset */
            $intangibleAsset = $this->intangibleAssetRepository->getById($intangibleAsset);

            if ($hasStrategiesOption == -1) {
                $intangibleAsset->strategies()->delete();
                $this->intangibleAssetPhaseRepository->updateOrCreate(['intangible_asset_id' => $intangibleAsset->id], ['has_strategies' => false]);
            } else {
                $this->intangibleAssetPhaseRepository->updateOrCreate(['intangible_asset_id' => $intangibleAsset->id], ['has_strategies' => false]);
            }
            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.intangible_assets.strategies.messages.save_success')]);
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.intangible_assets.strategies.messages.save_error')]);
        }
    }
}
