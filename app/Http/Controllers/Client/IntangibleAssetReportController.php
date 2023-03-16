<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;

use App\Jobs\CreateFileReportJob;

use App\Repositories\Admin\IntangibleAssetStateRepository;
use App\Repositories\Admin\IntellectualPropertyRightProductRepository;
use App\Repositories\Admin\IntellectualPropertyRightSubcategoryRepository;
use App\Repositories\Client\IntangibleAssetRepository;
use App\Repositories\Client\ResearchUnitRepository;

class IntangibleAssetReportController extends Controller
{
    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    /** @var IntellectualPropertyRightSubcategoryRepository */
    protected $intellectualPropertyRightSubcategoryRepository;

    /** @var IntellectualPropertyRightProductRepository */
    protected $intellectualPropertyRightProductRepository;

    /** @var IntangibleAssetStateRepository */
    protected $intangibleAssetStateRepository;

    /** @var ResearchUnitRepository */
    protected $researchUnitRepository;

    public function __construct(
        IntangibleAssetRepository $intangibleAssetRepository,
        IntellectualPropertyRightSubcategoryRepository $intellectualPropertyRightSubcategoryRepository,
        IntellectualPropertyRightProductRepository $intellectualPropertyRightProductRepository,
        IntangibleAssetStateRepository $intangibleAssetStateRepository,

        ResearchUnitRepository $researchUnitRepository
    ) {
        $this->middleware('auth');

        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->intellectualPropertyRightSubcategoryRepository = $intellectualPropertyRightSubcategoryRepository;
        $this->intellectualPropertyRightProductRepository = $intellectualPropertyRightProductRepository;
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;
        $this->researchUnitRepository = $researchUnitRepository;
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
        $rules = [];

        $generalConfiguration = $request->only([
            'with_general_total', 'with_general_phase_status'
        ]);

        $graphicConfiguration = $request->only([
            'with_graphics_assets_per_year', 'with_graphics_assets_classification_per_year', 'with_graphics_assets_state_per_year',
            'with_graphics_assets_classification_per_administrative_unit', 'with_graphics_assets_state_research_unit_per_administrative_unit', 'with_graphics_assets_research_unit_per_administrative_unit',
            'with_graphics_assets_research_unit_per_administrative_unit', 'with_graphics_assets_classification_per_research_unit'
        ]);

        
        $rules = $this->getRulesPerGraphicConfiguration($rules, $graphicConfiguration);
        dd($rules);

        $request->validate($rules);

        $params = $request->all();

        try {
            Log::alert('GENERATING CUSTOM REPORT');

            Log::info('Searching Intangible Assets..');

            # Default Array
            $withRelations =  [];

            $selectData = [
                "intangible_assets.id",
            ];

            /** Relations per Graphic Configuration */
            [$withRelations, $selectData] = $this->getRelationsArrayPerGraphicConfiguration($withRelations, $selectData, $graphicConfiguration);
            /** ./Relations per Graphic Configuration */

            /** @var Collection $intangibleAssets */
            $intangibleAssets = $this->intangibleAssetRepository->searchForReport($params, $withRelations, [], $selectData)->get();

            return $intangibleAssets;

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
                'generalConfiguration' => $generalConfiguration,
                // 'contentConfiguration' => $contentConfiguration,
                'graphicConfiguration' => $graphicConfiguration,
                'count' => $count,
                'client' => $client,
            ];

            /** Testing the View Custom PDF */

            // $dataCompact = compact('generalConfiguration', 'contentConfiguration', 'graphicConfiguration', 'count', 'client');

            if (isset($dataCompact) && $dataCompact) {

                if (!empty($contentConfiguration) || !empty($generalConfiguration)) {
                    $dataCompact['intangibleAssets'] = $intangibleAssets;
                }

                if (hasContent($generalConfiguration, 'with_general_phase_status')) $dataCompact['phasesCompleted'] = $this->getPhasesCompletedArray($intangibleAssets);

                if (hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_year')) {
                    $response = $this->getDataGraphicIntangibleAssetClassificationPerYear($intangibleAssets, $dataCompact);

                    $dataCompact = $response;
                }

                if (hasContent($graphicConfiguration, 'with_graphics_assets_per_year')) {
                    $response = $this->getDataGraphicIntangibleAssetPerYear($intangibleAssets, $dataCompact);


                    $dataCompact = $response;
                }

                if (hasContent($graphicConfiguration, 'with_graphics_assets_state_per_year')) {
                    $response = $this->getDataGraphicIntangibleAssetsStatesPerYear($intangibleAssets, $dataCompact);
                    $dataCompact = $response;
                }

                if (hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_administrative_unit')) {
                    $response = $this->getDataGraphicIntangibleAssetClassificationPerAdministrativeUnit($intangibleAssets, $dataCompact);
                    $dataCompact = $response;
                }

                if (hasContent($graphicConfiguration, 'with_graphics_assets_state_research_unit_per_administrative_unit')) {
                    $response = $this->getDataGraphicIntangibleAssetStateResearchUnitPerAdministrativeUnit($intangibleAssets, $dataCompact);
                    $dataCompact = $response;
                }

                if (hasContent($graphicConfiguration, 'with_graphics_assets_research_unit_per_administrative_unit')) {
                    $response = $this->getDataGraphicIntangibleStateResearchUnitPerAdministrativeUnit($intangibleAssets, $request, $dataCompact);
                    $dataCompact = $response;
                }

                if (hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_research_unit')) {
                    $response = $this->getDataGraphicIntangibleAssetClassificationPerResearchUnit($intangibleAssets, $dataCompact);
                    $dataCompact = $response;
                }

                return $dataCompact;

                return view('reports.intangible_assets.custom', $dataCompact);
            }
            /** ./Testing the View Custom PDF */


            # Graphics Configuration

            if (!empty($graphicConfiguration)) {

                $data['graphicData'] = [];

                if (hasContent($graphicConfiguration, 'with_graphics_assets_per_year')) {
                    $response = $this->getDataGraphicIntangibleAssetPerYear($intangibleAssets, $data);
                    $data = $response;
                }

                if (hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_year')) {
                    $response = $this->getDataGraphicIntangibleAssetClassificationPerYear($intangibleAssets, $data);
                    $data = $response;
                }

                if (hasContent($graphicConfiguration, 'with_graphics_assets_state_per_year')) {
                    $response = $this->getDataGraphicIntangibleAssetsStatesPerYear($intangibleAssets, $data);
                    $data = $response;
                }

                if (hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_administrative_unit')) {
                    $response = $this->getDataGraphicIntangibleAssetClassificationPerAdministrativeUnit($intangibleAssets, $data);
                    $data = $response;
                }

                if (hasContent($graphicConfiguration, 'with_graphics_assets_state_research_unit_per_administrative_unit')) {
                    $response = $this->getDataGraphicIntangibleAssetStateResearchUnitPerAdministrativeUnit($intangibleAssets, $data);
                    $data = $response;
                }

                if (hasContent($graphicConfiguration, 'with_graphics_assets_research_unit_per_administrative_unit')) {
                    $response = $this->getDataGraphicIntangibleStateResearchUnitPerAdministrativeUnit($intangibleAssets, $request, $data);
                    $data = $response;
                }

                if (hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_research_unit')) {
                    $response = $this->getDataGraphicIntangibleAssetClassificationPerResearchUnit($intangibleAssets, $data);
                    $data = $response;
                }
            }

            if (!empty($graphicConfiguration) && !empty($generalConfiguration)) {
                Log::notice('One report file will be created!');
                if (!empty($contentConfiguration) || !empty($generalConfiguration)) $data['intangibleAssets'] = $intangibleAssets;
                if (hasContent($generalConfiguration, 'with_general_phase_status')) $data['phasesCompleted'] = $this->getPhasesCompletedArray($intangibleAssets);

                $this->callJobReportCustom($data, $config);
            } else {
                if ($count < 50) {
                    Log::notice('One report file will be created!');


                    $data['intangibleAssets'] = $intangibleAssets;
                    if (hasContent($generalConfiguration, 'with_general_phase_status')) $data['phasesCompleted'] = $this->getPhasesCompletedArray($intangibleAssets);

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

            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.intangible_assets.reports.single.messages.generate_success')]);
        }
    }

    /**
     * @param array $data
     * @param array $config
     */
    protected function callJobReportCustom($data, $config)
    {
        CreateFileReportJob::dispatch($data, $config)->onQueue('intangible_assets-reports-custom');
    }

    ### RELATIONS ARRAY PER GRAPHIC CONFIGURATION

    /**
     * @param array $withRelations
     * @param array $selectData
     * @param array $graphicConfiguration
     * 
     * @return array
     */
    protected function getRelationsArrayPerGraphicConfiguration(array $withRelations, array $selectData, array $graphicConfiguration): array
    {
        if (!in_array('intangible_assets.date', $selectData) && hasContent($graphicConfiguration, 'with_graphics_assets_per_year')) {
            array_push($selectData, 'intangible_assets.date');
        }

        if (!in_array('intangible_asset_state', $withRelations) && hasContent($graphicConfiguration, 'with_graphics_assets_state_per_year')) {
            array_push($withRelations, 'intangible_asset_state');
        }

        if (!in_array('intangible_asset_state_id', $selectData) && hasContent($graphicConfiguration, 'with_graphics_assets_state_per_year')) {
            array_push($selectData, 'intangible_assets.intangible_asset_state_id');
            array_push($selectData, 'intangible_assets.date');
        }

        if (!in_array('classification', $withRelations) && hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_year')) {
            array_push($withRelations, 'classification');
        }

        if (!in_array('classification_id', $selectData) && hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_year')) {
            array_push($selectData, 'intangible_assets.classification_id');
        }

        if (!in_array('classification', $withRelations) && (hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_administrative_unit') ||
            hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_research_unit'))) {
            array_push($withRelations, 'classification');
        }

        if (!in_array('classification_id', $selectData) && (hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_administrative_unit') ||
            hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_research_unit'))) {
            array_push($selectData, 'intangible_assets.classification_id');
        }

        if (!in_array('project', $withRelations) && hasContent($graphicConfiguration, 'with_graphics_assets_research_unit_per_administrative_unit')) {
            array_push($withRelations, 'project:id,research_unit_id,name');
        }

        if (!in_array('intangible_assets.project_id', $selectData) && hasContent($graphicConfiguration, 'with_graphics_assets_research_unit_per_administrative_unit')) {
            array_push($selectData, 'intangible_assets.project_id');
        }

        if (!in_array('project.research_unit:id,administrative_unit_id,name', $withRelations) && hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_research_unit')) {
            array_push($selectData, 'intangible_assets.project_id');
            array_push($withRelations, 'project.research_unit:id,administrative_unit_id,name');
        }


        return [$withRelations, $selectData];
    }

    /**
     * @param array $rules
     * @param array $graphicConfiguration
     */
    protected function getRulesPerGraphicConfiguration(array $rules, array $graphicConfiguration): array
    {
        if (
            !in_array('administrative_unit_id', $rules)
            && (hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_administrative_unit')
                || hasContent($graphicConfiguration, 'with_graphics_assets_state_research_unit_per_administrative_unit')
                || hasContent($graphicConfiguration, 'with_graphics_assets_research_unit_per_administrative_unit'))
        ) {
            $rules['administrative_unit_id'] = ['required', 'exists:tenant.administrative_units,id'];
        }

        if (!in_array('research_unit_id', $rules) && hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_research_unit')) {
            $rules['research_unit_id'] = ['required', 'exists:tenant.research_units,id'];
        }

        return $rules;
    }

    ### BUILDING GRAPHIC DATA ARRAY

    /**
     * @param Collection $intangibleAssets
     * 
     * @return array
     */
    protected function getPhasesCompletedArray(Collection $intangibleAssets): array
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

    /**
     * @param Collection $intangibleAssets
     * @param array $dataArray
     * 
     * @return array
     */
    protected function getDataGraphicIntangibleAssetPerYear(Collection $intangibleAssets, array $dataArray): array
    {
        $items = $intangibleAssets->groupBy(function ($val) {
            return \Carbon\Carbon::parse($val->date)->format('Y');
        });

        $labels = [];

        $data = [];

        foreach ($items as $key => $item) {
            array_push($labels, $key);
            array_push($data, $item->count());
        }

        $datasets = [
            [
                'label' => 'Activos Intangibles',
                'data' => $data,
                'backgroundColor' => 'red',
            ],
        ];

        $data = [
            'labels' => $labels,
            'datasets' => $datasets,
        ];

        $dataArray['graphicData']['with_graphics_assets_per_year'] = [
            'items' => $items,
            'type' => 'bar',
            'data' => $data,
        ];

        return $dataArray;
    }

    /**
     * @param Collection $intangibleAssets
     * @param array $dataArray
     * 
     * @return array
     */
    protected function getDataGraphicIntangibleAssetClassificationPerYear(Collection $intangibleAssets, array $dataArray): array
    {
        /** @var Collection $products */
        $products = $this->intellectualPropertyRightProductRepository->search([])->get();

        $productArray = $products->split(8);

        $intangibleAssetsPerYear = $intangibleAssets->groupBy(function ($val) {
            return \Carbon\Carbon::parse($val->date)->format('Y');
        });

        $labels = [];
        foreach ($intangibleAssetsPerYear as $key => $items) {
            array_push($labels, $key);
        }


        $dataArray['graphicData']['with_graphics_assets_classification_per_year'] = [];

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
            array_push($dataArray['graphicData']['with_graphics_assets_classification_per_year'], ['labels' => $labels, 'datasets' => $datasets]);
        }

        return $dataArray;
    }

    /**
     * @param Collection $intangibleAssets
     * @param array $dataArray
     */
    protected function getDataGraphicIntangibleAssetsStatesPerYear(Collection $intangibleAssets, array $dataArray): array
    {
        $states = $this->intangibleAssetStateRepository->all(['id', 'name']);

        $intangibleAssetsPerYear = $intangibleAssets->groupBy(function ($val) {
            return \Carbon\Carbon::parse($val->date)->format('Y');
        });

        $labels = [];
        foreach ($intangibleAssetsPerYear as $key => $items) {
            array_push($labels, $key);
        }

        $dataArray['graphicData']['with_graphics_assets_state_per_year'] = [];

        $datasets = [];
        foreach ($states as $state) {
            $dataArrayState = [];

            foreach ($labels as $label) {
                array_push($dataArrayState, $intangibleAssets->where('intangible_asset_state_id', $state->id)->where(function ($val) use ($label) {
                    $year = (int)\Carbon\Carbon::parse($val->date)->format('Y');
                    return $year == $label;
                })->count());
            }
            array_push($datasets, ['label' => $state->name, 'data' => $dataArrayState]);
        }

        $dataArray['graphicData']['with_graphics_assets_state_per_year'] = ['labels' => $labels, 'datasets' => $datasets];

        return $dataArray;
    }

    /**
     * @param Collection $intangibleAssets
     * @param array $dataArray
     */
    protected function getDataGraphicIntangibleAssetClassificationPerAdministrativeUnit(Collection $intangibleAssets, array $dataArray): array
    {
        $products = $this->intellectualPropertyRightProductRepository->all(['id', 'name']);

        $productSplitArray = $products->split(8);

        $bodyArray = [];
        foreach ($productSplitArray as $key => $productItemsArray) {
            $labels = [];
            $data = [];
            $datasets = [];
            if ($key == 0) {
                if (($nullIntangibleAssets = $intangibleAssets->whereNull('classification_id')->count()) > 0) {
                    array_push($labels, "Sin Clasificacion [{$nullIntangibleAssets}]");
                    array_push($data, $nullIntangibleAssets);
                }
            }
            /** @var Collection $productItemsArray */
            foreach ($productItemsArray as $productItem) {
                $count = $intangibleAssets->where('classification_id', $productItem->id)->count();
                array_push($labels, "{$productItem->name} [{$count}]");
                array_push($data, $count);
            }
            array_push($datasets, ['data' => $data]);
            array_push($bodyArray, ['type' => 'doughnut', 'data' => ['labels' => $labels, 'datasets' => $datasets]]);
        }

        $dataArray['graphicData']['with_graphics_assets_classification_per_administrative_unit'] = $bodyArray;

        return $dataArray;
    }

    /**
     * @param Collection $intangibleAssets
     * @param array $dataArray
     */
    protected function getDataGraphicIntangibleAssetStateResearchUnitPerAdministrativeUnit(Collection $intangibleAssets, array $dataArray): array
    {
        return $dataArray;
    }

    /**
     * @param Collection $intangibleAssets
     * @param Request $request
     * @param array $dataArray
     */
    protected function getDataGraphicIntangibleStateResearchUnitPerAdministrativeUnit(Collection $intangibleAssets, $request, array $dataArray)
    {
        $researchUnits = $this->researchUnitRepository->all(['id', 'administrative_unit_id', 'name'])->where('administrative_unit_id', $request->administrative_unit_id);

        $labels = [];

        $data = [];

        /** @var \App\Models\Client\ResearchUnit $researchUnit */
        foreach ($researchUnits as $researchUnit) {
            array_push($labels, $researchUnit->name);

            $count = $intangibleAssets->where(function ($asset) use ($researchUnit) {
                return $asset->project->research_unit_id === $researchUnit->id;
            })->count();

            array_push($data, $count);
        }

        $datasets = [
            [
                'label' => 'Activos Intangibles',
                'data' => $data,
            ],
        ];

        $data = [
            'labels' => $labels,
            'datasets' => $datasets,
        ];

        $dataArray['graphicData']['with_graphics_assets_research_unit_per_administrative_unit'] = [
            'type' => 'pie',
            'data' => $data,
        ];

        return $dataArray;
    }

    /**
     * @param Collection $intangibleAssets
     * @param array $dataArray
     */
    protected function getDataGraphicIntangibleAssetClassificationPerResearchUnit(Collection $intangibleAssets, array $dataArray)
    {
        $products = $this->intellectualPropertyRightProductRepository->all(['id', 'name']);

        $productSplitArray = $products->split(8);

        $bodyArray = [];
        foreach ($productSplitArray as $key => $productItemsArray) {
            $labels = [];
            $data = [];
            $datasets = [];
            if ($key == 0) {
                if (($nullIntangibleAssets = $intangibleAssets->whereNull('classification_id')->count()) > 0) {
                    array_push($labels, 'Sin Clasificación');
                    array_push($data, $nullIntangibleAssets);
                }
            }
            /** @var Collection $productItemsArray */
            foreach ($productItemsArray as $productItem) {
                array_push($labels, $productItem->name);
                array_push($data, $intangibleAssets->where('classification_id', $productItem->id)->count());
            }
            array_push($datasets, ['data' => $data]);
            array_push($bodyArray, ['type' => 'pie', 'data' => ['labels' => $labels, 'datasets' => $datasets]]);
        }

        $dataArray['graphicData']['with_graphics_assets_classification_per_research_unit'] = $bodyArray;

        return $dataArray;
    }
}
