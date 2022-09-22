<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use App\Repositories\Client\IntangibleAssetPhaseRepository;
use App\Repositories\Client\IntangibleAssetRepository;
use App\Repositories\Client\StrategyCategoryRepository;

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


    /**
     * @param int $id
     * @param int $intangibleAsset
     * 
     * @return View
     */
    public function index($id, $intangibleAsset) #: View
    {
        try {

            $item = $this->intangibleAssetRepository->getByIdWithRelations($intangibleAsset, [
                'strategies', 'strategies.strategy', 'strategies.user'
            ]);

            return view('client.pages.intangible_assets.strategies', compact('item'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * @param int $id
     * @param int $intangibleAsset
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function updateHasStrategies($id, $intangibleAsset, Request $request): RedirectResponse
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
                $this->intangibleAssetPhaseRepository->updateOrCreate(['intangible_asset_id' => $intangibleAsset->id], ['has_strategies' => true]);
            }
            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.intangible_assets.strategies.messages.save_success')]);
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.intangible_assets.strategies.messages.save_error')]);
        }
    }
}
