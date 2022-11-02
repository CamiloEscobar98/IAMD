<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Jobs\CreateFileReportJob;
use App\Repositories\Admin\IntellectualPropertyRightProductRepository;
use App\Repositories\Admin\IntellectualPropertyRightSubcategoryRepository;
use App\Repositories\Client\IntangibleAssetRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class IntangibleAssetReportController extends Controller
{
    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    /** @var IntellectualPropertyRightSubcategoryRepository */
    protected $intellectualPropertyRightSubcategoryRepository;

    /** @var IntellectualPropertyRightProductRepository */
    protected $intellectualPropertyRightProductRepository;

    public function __construct(
        IntangibleAssetRepository $intangibleAssetRepository,
        IntellectualPropertyRightSubcategoryRepository $intellectualPropertyRightSubcategoryRepository,
        IntellectualPropertyRightProductRepository $intellectualPropertyRightProductRepository
    ) {
        $this->middleware('auth');

        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->intellectualPropertyRightSubcategoryRepository = $intellectualPropertyRightSubcategoryRepository;
        $this->intellectualPropertyRightProductRepository = $intellectualPropertyRightProductRepository;
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

        $generalConfiguration = $request->only([
            'with_general_total', 'with_general_phase_status'
        ]);

        $contentConfiguration = $request->only([
            'with_basic_information', 'with_dpis', 'with_published',
            'with_confidenciality_contract', 'with_creators', 'with_right_session',
            'with_contability', 'with_comments', 'with_protection_action', 'with_priority_tools', 'with_commercial'
        ]);

        $graphicConfiguration = $request->only([
            'with_graphics_assets_per_year', 'with_graphics_assets_classification_per_year', 'with_graphics_default'
        ]);

        try {
            Log::alert('GENERATING CUSTOM REPORT');

            Log::info('Searching Intangible Assets..');

            $withRelations =  [
                'secret_protection_measures'
            ];

            if (hasContent($contentConfiguration, 'with_basic_information')) {
                array_push($withRelations, 'project.research_unit.administrative_unit');
                array_push($withRelations, 'intangible_asset_state');
                array_push($withRelations, 'classification');
            }

            if (hasContent($contentConfiguration, 'with_published')) {
                array_push($withRelations, 'intangible_asset_published');
            }

            if (hasContent($contentConfiguration, 'with_confidenciality_contract')) {
                array_push($withRelations, 'intangible_asset_confidenciality_contract');
            }

            if (hasContent($contentConfiguration, 'with_creators')) {
                array_push($withRelations, 'creators');
            }

            if (hasContent($contentConfiguration, 'with_right_session')) {
                array_push($withRelations, 'intangible_asset_session_right_contract');
            }

            if (hasContent($contentConfiguration, 'with_contability')) {
                array_push($withRelations, 'intangible_asset_contability');
            }

            if (hasContent($contentConfiguration, 'with_comments')) {
                array_push($withRelations, 'user_messages');
            }

            if (hasContent($contentConfiguration, 'with_protection_action')) {
                array_push($withRelations, 'intangible_asset_protection_action');
            }

            if (hasContent($contentConfiguration, 'with_priority_tools')) {
                array_push($withRelations, 'priority_tools.priority_tool');
                array_push($withRelations, 'priority_tools.dpi');
            }

            if (hasContent($contentConfiguration, 'with_commercial')) {
                array_push($withRelations, 'intangible_asset_commercial');
            }

            if (hasContent($contentConfiguration, 'with_dpis')) {
                array_push($withRelations, 'dpis.dpi');
            }

            /** @var Collection $intangibleAssets */
            $intangibleAssets = $this->intangibleAssetRepository->search($params, $withRelations)->get();

            Log::notice('Intangible Assets searched!');

            $count = $intangibleAssets->count();

            Log::info("Total Intangible Assets {$count}");

            $userId = auth('web')->user()->id;
            $client = $request->client;
            $reportType = 'intangible_assets.reports.custom';

            $config = [
                'userId' => $userId,
                'client' => $client,
                'report_type' => $reportType
            ];

            $data = [
                'count' => $count,
                'client' => $client,
                'generalConfiguration' => $generalConfiguration,
                'contentConfiguration' => $contentConfiguration,
                'graphicConfiguration' => $graphicConfiguration,
            ];

            $phasesCompleted = $this->getPhasesCompletedArray($intangibleAssets);

            $dataCompact = compact('generalConfiguration', 'contentConfiguration', 'graphicConfiguration', 'phasesCompleted', 'intangibleAssets', 'count', 'client');

            if (hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_year')) {
                /** @var Collection $products */
                $products = $this->intellectualPropertyRightProductRepository->search([])->get();

                $productArray = $products->split(8);

                $intangibleAssetsGroupByClassification = $intangibleAssets->groupBy(function ($val) {
                    return \Carbon\Carbon::parse($val->date)->format('Y');
                });

                $labels = [];
                foreach ($intangibleAssetsGroupByClassification as $key => $items) {
                    array_push($labels, $key);
                }

                $dataCompact['graphicData'] = [
                    'with_graphics_assets_classification_per_year' => []
                ];

                foreach ($productArray as $productArrayItem) {
                    $datasets = [];
                    foreach ($productArrayItem as $productItem) {
                        $dataArrayClassification = [];

                        foreach ($labels as $label) {
                            array_push($dataArrayClassification, $intangibleAssets->where('classification_id', $productItem->id)->where(function ($val) use ($label) {
                                $year = (int)\Carbon\Carbon::parse($val->date)->format('Y');
                                return $year == $label;
                            })->count());
                        }
                        array_push($datasets, ['label' => $productItem->name, 'data' => $dataArrayClassification]);
                    }
                    array_push($dataCompact['graphicData']['with_graphics_assets_classification_per_year'], ['labels' => $labels, 'datasets' => $datasets]);
                }
            }

            // return $dataCompact;

            // return view('reports.intangible_assets.custom', $dataCompact);



            if (!empty($graphicConfiguration) || !empty($generalConfiguration)) {
                Log::notice('One report file will be created!');
                $phasesCompleted = $this->getPhasesCompletedArray($intangibleAssets);

                $data['intangibleAssets'] = $intangibleAssets;
                $data['phasesCompleted'] = $phasesCompleted;
                $data['graphicData'] = $dataCompact['graphicData'];

                $this->callJobReportCustom($data, $config);
            } else {
                if ($count < 50) {
                    Log::notice('One report file will be created!');
                    $phasesCompleted = $this->getPhasesCompletedArray($intangibleAssets);

                    $data['intangibleAssets'] = $intangibleAssets;
                    $data['phasesCompleted'] = $phasesCompleted;

                    $this->callJobReportCustom($data, $config);
                } else {
                    $splitIntangibleAssets = [];

                    if ($count > 1000) {
                        $fileCount = 8;
                        $splitIntangibleAssets = $intangibleAssets->split($fileCount);
                    } elseif ($count > 500 && $count < 1000) {
                        $fileCount = 6;
                        $splitIntangibleAssets = $intangibleAssets->split($fileCount);
                    } elseif ($count > 100 && $count < 500) {
                        $fileCount = 4;
                        $splitIntangibleAssets = $intangibleAssets->split($fileCount);
                    } elseif ($count > 50 && $count < 100) {
                        $fileCount = 2;
                        $splitIntangibleAssets = $intangibleAssets->split($fileCount);
                    }

                    Log::notice("Total Report Files will be created: {$fileCount}");

                    foreach ($splitIntangibleAssets as $split) {
                        $phasesCompleted = $this->getPhasesCompletedArray($split);

                        $data['intangibleAssets'] = $split;
                        $data['phasesCompleted'] = $phasesCompleted;

                        $this->callJobReportCustom($data, $config);
                    }
                }
            }
            Log::alert('CUSTOM REPORT ALERT FINISHED');

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.intangible_assets.reports.single.messages.generate_success')]);
        } catch (\Exception $th) {
            return $th->getMessage();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.intangible_assets.reports.single.messages.generate_success')]);
        }
    }

    /**
     * @param array $data
     * @param array $config
     */
    private function callJobReportCustom($data, $config)
    {
        CreateFileReportJob::dispatch($data, $config)->onQueue('intangible_assets-reports-custom');
    }

    /**
     * @param Collection $intangibleAssets
     * 
     * @return array
     */
    public function getPhasesCompletedArray($intangibleAssets): array
    {
        return [
            'allPhasesCompleted' => $intangibleAssets->where(function ($intangibleAsset) {
                return $intangibleAsset->hasAllPhasesCompleted();
            })->count(),

            'phaseOneCompleted' => $intangibleAssets->where(function ($intangibleAsset) {
                return $intangibleAsset->hasPhaseOneCompleted();
            })->count(),

            'phaseTwoCompleted' => $intangibleAssets->where(function ($intangibleAsset) {
                return $intangibleAsset->hasPhaseTwoCompleted();
            })->count(),

            'phaseThreeCompleted' => $intangibleAssets->where(function ($intangibleAsset) {
                return $intangibleAsset->hasPhaseThreeCompleted();
            })->count(),

            'phaseFourCompleted' => $intangibleAssets->where(function ($intangibleAsset) {
                return $intangibleAsset->hasPhaseFourCompleted();
            })->count(),

            'phaseFiveCompleted' => $intangibleAssets->where(function ($intangibleAsset) {
                return $intangibleAsset->hasPhaseFiveCompleted();
            })->count(),

            'phaseSixCompleted' => $intangibleAssets->where(function ($intangibleAsset) {
                return $intangibleAsset->hasPhaseSixCompleted();
            })->count(),

            'phaseSevenCompleted' => $intangibleAssets->where(function ($intangibleAsset) {
                return $intangibleAsset->hasPhaseSevenCompleted();
            })->count(),

            'phaseEightCompleted' => $intangibleAssets->where(function ($intangibleAsset) {
                return $intangibleAsset->hasPhaseEightCompleted();
            })->count(),

            'phaseNineCompleted' => $intangibleAssets->where(function ($intangibleAsset) {
                return $intangibleAsset->hasPhaseNineCompleted();
            })->count(),
        ];
    }
}
