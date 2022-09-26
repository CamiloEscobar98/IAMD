<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Jobs\CreateFileReportJob;

use App\Repositories\Admin\IntangibleAssetTypeLevel2Repository;
use App\Repositories\Client\IntangibleAssetRepository;

class IntangibleAssetReportController extends Controller
{
    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    /** @var IntangibleAssetTypeLevel2Repository */
    protected $intangibleAssetTypeLevel2Repository;

    public function __construct(
        IntangibleAssetRepository $intangibleAssetRepository,
        IntangibleAssetTypeLevel2Repository $intangibleAssetTypeLevel2Repository,
    ) {
        $this->middleware('auth');

        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->intangibleAssetTypeLevel2Repository = $intangibleAssetTypeLevel2Repository;
    }

    /**
     * @param int $id
     * @param int $intangibleAsset
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function downloadDefaultReport($id, $intangibleAsset, Request $request)
    {
        try {

            $intangibleAsset = $this->intangibleAssetRepository->getByIdWithRelations($intangibleAsset, [
                'project.research_unit.administrative_unit', 'intangible_asset_state', 'classification', 'dpis.dpi',
                'intangible_asset_published', 'intangible_asset_confidenciality_contract', 'intangible_asset_session_right_contract', 'intangible_asset_contability',
                'user_messages', 'intangible_asset_protection_action', 'secret_protection_measures', 'priority_tools.priority_tool', 'priority_tools.dpi', 'intangible_asset_commercial'
            ]);

            // return $intangibleAsset;

            CreateFileReportJob::dispatch([
                'intangibleAsset' => $intangibleAsset,
                'dpis' => $this->intangibleAssetTypeLevel2Repository->all()
            ], [
                'userId' => auth('web')->user()->id,
                'client' => $request->client,
                'report_type' => 'intangible_assets.reports.single'
            ]);

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.intangible_assets.reports.single.messages.generate_success')]);
        } catch (\Exception $th) {
            return $th->getMessage();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.intangible_assets.reports.single.messages.generate_success')]);
        }
    }
}
