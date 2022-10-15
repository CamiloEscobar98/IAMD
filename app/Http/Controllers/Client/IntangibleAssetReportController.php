<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Jobs\CreateFileReportJob;

use App\Repositories\Admin\IntellectualPropertyRightSubcategoryRepository;
use App\Repositories\Client\IntangibleAssetRepository;
use Illuminate\Database\Eloquent\Collection;

class IntangibleAssetReportController extends Controller
{
    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    /** @var IntellectualPropertyRightSubcategoryRepository */
    protected $intellectualPropertyRightSubcategoryRepository;

    public function __construct(
        IntangibleAssetRepository $intangibleAssetRepository,
        IntellectualPropertyRightSubcategoryRepository $intellectualPropertyRightSubcategoryRepository,
    ) {
        $this->middleware('auth');

        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->intellectualPropertyRightSubcategoryRepository = $intellectualPropertyRightSubcategoryRepository;
    }

    /**
     * @param int $id
     * @param int $intangibleAsset
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function generateDefaultReport($id, $intangibleAsset, Request $request)
    {
        try {

            $intangibleAsset = $this->intangibleAssetRepository->getByIdWithRelations($intangibleAsset, [
                'project.research_unit.administrative_unit', 'intangible_asset_state', 'classification', 'dpis.dpi',
                'intangible_asset_published', 'intangible_asset_confidenciality_contract', 'intangible_asset_session_right_contract', 'intangible_asset_contability',
                'user_messages', 'intangible_asset_protection_action', 'secret_protection_measures', 'priority_tools.priority_tool', 'priority_tools.dpi', 'intangible_asset_commercial'
            ]);

            CreateFileReportJob::dispatch([
                'intangibleAsset' => $intangibleAsset,
                'dpis' => $this->intellectualPropertyRightSubcategoryRepository->all(),
                'client' => $request->client
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

    /**
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function generateCustomReport(Request $request) #: RedirectResponse
    {
        $params = $request->all();

        try {

            /** @var Collection $intangibleAssets */
            $intangibleAssets = $this->intangibleAssetRepository->search($params, [
                'project.research_unit.administrative_unit', 'intangible_asset_state', 'classification', 'dpis.dpi',
                'intangible_asset_published', 'intangible_asset_confidenciality_contract', 'intangible_asset_session_right_contract', 'intangible_asset_contability',
                'user_messages', 'intangible_asset_protection_action', 'secret_protection_measures', 'priority_tools.priority_tool', 'priority_tools.dpi', 'intangible_asset_commercial'
            ])->get();

            $dpis = $this->intellectualPropertyRightSubcategoryRepository->all();

            $count = $intangibleAssets->count();

            if ($count < 50) {
                $phasesCompleted = $this->getPhasesCompletedArray($intangibleAssets);
                $this->callJobReportCustom($intangibleAssets, $phasesCompleted, $dpis, auth('web')->user()->id, $request->client);
            } else {
                $splitIntangibleAssets = [];

                if ($count > 1000) {
                    $splitIntangibleAssets = $intangibleAssets->split(8);
                } elseif ($count > 500 && $count < 1000) {
                    $splitIntangibleAssets = $intangibleAssets->split(6);
                } elseif ($count > 100 && $count < 500) {
                    $splitIntangibleAssets = $intangibleAssets->split(4);
                } elseif ($count > 50 && $count < 100) {
                    $splitIntangibleAssets = $intangibleAssets->split(2);
                }


                foreach ($splitIntangibleAssets as $split) {
                    $phasesCompleted = $this->getPhasesCompletedArray($split);
                    $this->callJobReportCustom($split, $phasesCompleted, $dpis, auth('web')->user()->id, $request->client);
                }
            }

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.intangible_assets.reports.single.messages.generate_success')]);
        } catch (\Exception $th) {
            return $th->getMessage();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.intangible_assets.reports.single.messages.generate_success')]);
        }
    }

    /**
     * @param Collection $intangibleAssets
     * @param Collection $dpis
     * @param int $userId
     * @param string $client
     */
    private function callJobReportCustom($intangibleAssets, $phasesCompleted, $dpis, $userId, $client)
    {
        CreateFileReportJob::dispatch([
            'intangibleAssets' => $intangibleAssets,
            'phasesCompleted' => $phasesCompleted,
            'dpis' => $dpis,
            'client' => $client
        ], [
            'userId' => $userId,
            'client' => $client,
            'report_type' => 'intangible_assets.reports.custom'
        ]);
    }

    /**
     * @param Collection $intangibleAssets
     * 
     * @return array
     */
    public function getPhasesCompletedArray($intangibleAssets): array
    {
        return [
            'allPhasesCompleted' => $allPhasesCompleted = $intangibleAssets->where(function ($intangibleAsset) {
                return $intangibleAsset->hasAllPhasesCompleted();
            })->count(),

            'phaseOneCompleted' => $phaseOneCompleted = $intangibleAssets->where(function ($intangibleAsset) {
                return $intangibleAsset->hasPhaseOneCompleted();
            })->count(),

            'phaseTwoCompleted' => $phaseTwoCompleted = $intangibleAssets->where(function ($intangibleAsset) {
                return $intangibleAsset->hasPhaseTwoCompleted();
            })->count(),

            'phaseThreeCompleted' => $phaseThreeCompleted = $intangibleAssets->where(function ($intangibleAsset) {
                return $intangibleAsset->hasPhaseThreeCompleted();
            })->count(),

            'phaseFourCompleted' => $phaseFourCompleted = $intangibleAssets->where(function ($intangibleAsset) {
                return $intangibleAsset->hasPhaseFourCompleted();
            })->count(),

            'phaseFiveCompleted' => $phaseFiveCompleted = $intangibleAssets->where(function ($intangibleAsset) {
                return $intangibleAsset->hasPhaseFiveCompleted();
            })->count(),

            'phaseSixCompleted' => $phaseSixCompleted = $intangibleAssets->where(function ($intangibleAsset) {
                return $intangibleAsset->hasPhaseSixCompleted();
            })->count(),

            'phaseSevenCompleted' => $phaseSevenCompleted = $intangibleAssets->where(function ($intangibleAsset) {
                return $intangibleAsset->hasPhaseSevenCompleted();
            })->count(),

            'phaseEightCompleted' => $phaseEightCompleted = $intangibleAssets->where(function ($intangibleAsset) {
                return $intangibleAsset->hasPhaseEightCompleted();
            })->count(),

            'phaseNineCompleted' => $phaseNineCompleted = $intangibleAssets->where(function ($intangibleAsset) {
                return $intangibleAsset->hasPhaseNineCompleted();
            })->count(),
        ];
    }
}
