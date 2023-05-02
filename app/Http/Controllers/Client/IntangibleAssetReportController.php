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
use App\Repositories\Admin\NotificationTypeRepository;
use App\Repositories\Client\IntangibleAssetRepository;
use App\Repositories\Client\ResearchUnitCategoryRepository;
use App\Repositories\Client\ResearchUnitRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Database\QueryException;

class IntangibleAssetReportController extends Controller
{
    /** @var NotificationTypeRepository */
    protected $notificationTypeRepository;

    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    /** @var IntellectualPropertyRightSubcategoryRepository */
    protected $intellectualPropertyRightSubcategoryRepository;

    /** @var IntellectualPropertyRightProductRepository */
    protected $intellectualPropertyRightProductRepository;

    /** @var IntangibleAssetStateRepository */
    protected $intangibleAssetStateRepository;

    /** @var ResearchUnitCategoryRepository */
    protected $researchUnitCategoryRepository;

    /** @var ResearchUnitRepository */
    protected $researchUnitRepository;

    public function __construct(
        NotificationTypeRepository $notificationTypeRepository,
        IntangibleAssetRepository $intangibleAssetRepository,
        IntellectualPropertyRightSubcategoryRepository $intellectualPropertyRightSubcategoryRepository,
        IntellectualPropertyRightProductRepository $intellectualPropertyRightProductRepository,
        IntangibleAssetStateRepository $intangibleAssetStateRepository,

        ResearchUnitCategoryRepository $researchUnitCategoryRepository,
        ResearchUnitRepository $researchUnitRepository
    ) {
        $this->middleware('auth');

        $this->notificationTypeRepository = $notificationTypeRepository;
        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->intellectualPropertyRightSubcategoryRepository = $intellectualPropertyRightSubcategoryRepository;
        $this->intellectualPropertyRightProductRepository = $intellectualPropertyRightProductRepository;
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;

        $this->researchUnitCategoryRepository = $researchUnitCategoryRepository;
        $this->researchUnitRepository = $researchUnitRepository;
    }

    /**
     * @param int $client
     * @param int $intangible_asset
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function generateDefaultReport($client, $intangible_asset, Request $request)
    {
        try {
            $intangibleAsset = $this->intangibleAssetRepository->getByIdWithRelations($intangible_asset, [
                'research_units.administrative_unit', 'intangible_asset_state', 'classification', 'dpis.dpi',
                'intangible_asset_published', 'intangible_asset_confidenciality_contract', 'intangible_asset_session_right_contract', 'intangible_asset_contability',
                'user_messages', 'intangible_asset_protection_action', 'secret_protection_measures', 'priority_tools.priority_tool', 'priority_tools.dpi', 'intangible_asset_commercial'
            ]);

            $data = [
                'intangibleAsset' => $intangibleAsset,
                'dpis' => $this->intellectualPropertyRightSubcategoryRepository->all(),
                'client' => $request->client
            ];

            CreateFileReportJob::dispatch([
                'intangibleAsset' => $intangibleAsset,
                'dpis' => $this->intellectualPropertyRightSubcategoryRepository->all(),
                'client' => $request->client
            ], [
                'userId' => auth('web')->user()->id,
                'client' => $request->client,
                'report_type' => 'intangible_assets.reports.single'
            ]);

            return redirect()->route('client.intangible_assets.show', compact('client', 'intangible_asset'))->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.intangible_assets.reports.single.messages.generate_success')]);
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/IntangibleAssetReportController:GenerateDefaultReport/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/IntangibleAssetReportController:GenerateDefaultReport/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.intangible_assets.show', compact('client', 'intangible_asset'))->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.intangible_assets.reports.single.messages.generate_error')]);
    }

    /**
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function generateCustomReport(Request $request) #: RedirectResponse
    {
        $rules = [];

        $graphicConfiguration = $request->only([
            'with_graphics_assets_per_year', 'with_graphics_assets_classification_per_year', 'with_graphics_assets_state_per_year',
            'with_graphics_assets_classification_per_administrative_unit', 'with_graphics_assets_state_research_unit_per_administrative_unit',
            'with_graphics_assets_research_unit_per_administrative_unit', 'with_graphics_assets_classification_per_research_unit', 'with_graphics_assets_state_classification_per_research_unit'
        ]);

        $rules = $this->getRulesPerGraphicConfiguration($rules, $graphicConfiguration);

        $messages = [
            'empty_graphics.required' => 'Es necesario al menos escoger una gráfica para poder realizar el reporte.'
        ];

        $request->validate($rules, $messages);

        $params = $request->all();

        $userId = auth('web')->user()->id;
        $client = $request->client;
        $reportType = 'intangible_assets.reports.custom';

        try {

            # Default Array
            $withRelations =  [];

            $selectData = [
                "intangible_assets.id",
            ];

            /** Relations per Graphic Configuration */
            [$withRelations, $selectData] = $this->getRelationsArrayPerGraphicConfiguration($withRelations, $selectData, $graphicConfiguration);
            /** ./Relations per Graphic Configuration */


            /** @var \Illuminate\Database\Query\Builder $query */
            $query = $this->intangibleAssetRepository->searchForReport($params, $withRelations, [], $selectData);

            /** @var Collection $intangibleAssets */
            $intangibleAssets = $query->get();

            Log::notice('Intangible Assets searched!');

            $count = $query->count();

            Log::info("Total Intangible Assets {$count}");

            $config = [
                'userId' => $userId,
                'client' => $client,
                'report_type' => $reportType
            ];

            $data = [
                'graphicConfiguration' => $graphicConfiguration,
                'count' => $count,
                'client' => $client,
            ];

            /** Testing the View Custom PDF */

            $dataCompact = compact('graphicConfiguration', 'count', 'client');

            if (isset($dataCompact) && $dataCompact) {

                if (hasContent($graphicConfiguration, 'with_graphics_assets_per_year')) {
                    $response = $this->getDataGraphicIntangibleAssetPerYear($intangibleAssets, $dataCompact);
                    $dataCompact = $response;
                }

                if (hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_year')) {
                    $response = $this->getDataGraphicIntangibleAssetClassificationPerYear($intangibleAssets, $dataCompact);

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

                if (hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_research_unit')) {
                    $response = $this->getDataGraphicIntangibleAssetClassificationPerResearchUnit($intangibleAssets, $dataCompact);
                    $dataCompact = $response;
                }

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

                if (hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_research_unit')) {
                    $response = $this->getDataGraphicIntangibleAssetClassificationPerResearchUnit($intangibleAssets, $data);
                    $data = $response;
                }
            }

            $this->callJobReportCustom($data, $config);

            Log::alert('CUSTOM REPORT ALERT FINISHED');

            return redirect()->route('client.reports.custom.index', $client)->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.intangible_assets.reports.single.messages.generate_success')]);
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/IntangibleAssetReportController:GenerateCustomReport/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/IntangibleAssetReportController:GenerateCustomReport/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.reports.custom.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.intangible_assets.reports.single.messages.generate_success')]);
    }

    /**
     * @param array $data
     * @param array $config
     */
    protected function callJobReportCustom($data, $config)
    {
        CreateFileReportJob::dispatch($data, $config);
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
            array_push($withRelations, 'classification.intellectual_property_right_subcategory.intellectual_property_right_category');
        }

        if (!in_array('classification_id', $selectData) && hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_year')) {
            array_push($selectData, 'intangible_assets.classification_id');
            array_push($selectData, 'intangible_assets.date');
            // array_push()
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
            array_push($withRelations, 'project:id,name');
        }

        if (!in_array('intangible_assets.project_id', $selectData) && hasContent($graphicConfiguration, 'with_graphics_assets_research_unit_per_administrative_unit')) {
            array_push($selectData, 'intangible_assets.project_id');
        }

        if (!in_array('project.research_unit:id,administrative_unit_id,name', $withRelations) && hasContent($graphicConfiguration, 'with_graphics_assets_classification_per_research_unit')) {
            array_push($selectData, 'intangible_assets.project_id');
            array_push($withRelations, 'project.research_units:id,administrative_unit_id,name');
        }


        return [$withRelations, $selectData];
    }

    /**
     * @param array $rules
     * @param array $graphicConfiguration
     */
    protected function getRulesPerGraphicConfiguration(array $rules, array $graphicConfiguration): array
    {
        if (empty($graphicConfiguration)) {
            $rules['empty_graphics'] = ['required'];
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
        $productQuery = $this->intellectualPropertyRightProductRepository->searchForReport([]);
        $productQuery->join('intellectual_property_right_subcategories', 'intellectual_property_right_products.intellectual_property_right_subcategory_id', 'intellectual_property_right_subcategories.id');
        /** @var Collection $products */
        $products = $productQuery->get();
        $productArray = $products->groupBy('intellectual_property_right_category_id');

        $productArrayAux = array();

        /** Recorrer todos lor Productos de Propiedad Intelectual */
        foreach ($productArray as $productArrayItem) {
            if (count($productArrayItem) > 5) {
                foreach ($productArrayItem->split(count($productArrayItem) / 6) as $item) {
                    array_push($productArrayAux, $item);
                }
            } else {
                array_push($productArrayAux, $productArrayItem);
            }
        }

        $productArray = $productArrayAux;

        $intangibleAssetsPerYear = $intangibleAssets->groupBy(function ($val) {
            return \Carbon\Carbon::parse($val->date)->format('Y');
        });

        $labels = [];
        // dd($intangibleAssetsPerYear);
        foreach ($intangibleAssetsPerYear as $key => $items) {
            array_push($labels, $key);
        }

        $dataArray['graphicData']['with_graphics_assets_classification_per_year'] = [];

        foreach ($productArray as $productArrayItem) {
            $datasets = [];
            foreach ($productArrayItem as $index => $productItem) {
                $dataArrayClassification = [];

                $hasLabel = false;
                $labelCount = 0;

                foreach ($labels as $label) {
                    $intangibleAssetCount = $intangibleAssets->where('classification_id', $productItem->id)->where(function ($val) use ($label) {
                        $year = (int)\Carbon\Carbon::parse($val->date)->format('Y');
                        return $year == $label;
                    })->count();

                    $labelCount += $intangibleAssetCount;

                    if ($intangibleAssetCount > 0) {
                        array_push($dataArrayClassification, $intangibleAssetCount);
                        $hasLabel = true;
                    }
                }
                if ($hasLabel) {
                    array_push($datasets, [
                        'label' => "{$productItem->name} [$labelCount]",
                        'data' => $dataArrayClassification
                    ]);
                }
            }
            array_push($dataArray['graphicData']['with_graphics_assets_classification_per_year'], [
                'title' => $productItem->intellectual_property_right_subcategory->intellectual_property_right_category->name,
                'labels' => $labels, 'datasets' => $datasets
            ]);
        }
        // dd($dataArray);
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
        /** @var \App\Models\Admin\IntangibleAssetState $state */
        foreach ($states as $state) {
            $dataArrayState = [];

            $hasLabel = false;
            $labelCount = 0;

            foreach ($labels as $label) {
                $intangibleAssetCount = $intangibleAssets->where('intangible_asset_state_id', $state->id)->where(function ($val) use ($label) {
                    $year = (int)\Carbon\Carbon::parse($val->date)->format('Y');
                    return $year == $label;
                })->count();
                if ($intangibleAssetCount > 0) {
                    array_push($dataArrayState, $intangibleAssetCount);
                    $hasLabel = true;
                }

                $labelCount += $intangibleAssetCount;
            }
            if ($hasLabel) {
                array_push($datasets, ['label' => "{$state->name}[$labelCount]", 'data' => $dataArrayState]);
            }
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

        $productQuery = $this->intellectualPropertyRightProductRepository->searchForReport([]);
        $productQuery->join('intellectual_property_right_subcategories', 'intellectual_property_right_products.intellectual_property_right_subcategory_id', 'intellectual_property_right_subcategories.id');
        /** @var Collection $products */
        $products = $productQuery->get();
        $productArray = $products->groupBy('intellectual_property_right_category_id');

        $productArrayAux = array();


        /** Recorrer todos lor Productos de Propiedad Intelectual */
        foreach ($productArray as $productArrayItem) {
            if (count($productArrayItem) > 5) {
                foreach ($productArrayItem->split(count($productArrayItem) / 5) as $item) {
                    array_push($productArrayAux, $item);
                }
            } else {
                array_push($productArrayAux, $productArrayItem);
            }
        }

        $productArray = $productArrayAux;

        $bodyArray = [];
        foreach ($productArray as $key => $productItemsArray) {
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
            array_push($bodyArray, ['type' => 'doughnut', 'data' => [
                'title' => $productItem->intellectual_property_right_subcategory->intellectual_property_right_category->name,
                'labels' => $labels, 'datasets' => $datasets
            ]]);
        }

        $dataArray['graphicData']['with_graphics_assets_classification_per_administrative_unit'] = $bodyArray;
        // dd($dataArray);
        return $dataArray;
    }

    /**
     * @param Collection $intangibleAssets
     * @param array $dataArray
     */
    protected function getDataGraphicIntangibleAssetClassificationPerResearchUnit(Collection $intangibleAssets, array $dataArray)
    {
        $researchUnitCategories = $this->researchUnitCategoryRepository->all(['id', 'name']);

        $researchUnitCategorySplitArray = $researchUnitCategories->split(2);

        $bodyArray = [];
        foreach ($researchUnitCategorySplitArray as $key => $researchUnitCategoryItemsArray) {
            $labels = [];
            $data = [];
            $datasets = [];
            if ($key == 0) {
                if (($nullIntangibleAssets = $intangibleAssets->filter(function ($intangibleAsset) {
                    return $intangibleAsset->research_units->isEmpty();
                })->count()) > 0) {
                    array_push($labels, "Sin Grupo de Investigación[{$nullIntangibleAssets}]");
                    array_push($data, $nullIntangibleAssets);
                }
            }
            /** @var Collection $researchUnitCategoryItemsArray */
            foreach ($researchUnitCategoryItemsArray as $researchUnitCategoryItem) {
                $count = $intangibleAssets->filter(function ($intangibleAsset) use ($researchUnitCategoryItem) {
                    return $intangibleAsset->research_units->where('research_unit_category_id', $researchUnitCategoryItem->id)->count() > 0;
                })->count();
                array_push($labels, "{$researchUnitCategoryItem->name}[{$count}]");
                array_push($data, $count);
            }
            array_push($datasets, ['data' => $data]);
            array_push($bodyArray, ['type' => 'pie', 'data' => ['labels' => $labels, 'datasets' => $datasets]]);
        }

        $dataArray['graphicData']['with_graphics_assets_classification_per_research_unit'] = $bodyArray;

        return $dataArray;
    }
}
