<?php

namespace App\Services\Client;

use App\Services\AbstractServiceModel;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;


use App\Repositories\Admin\IntellectualPropertyRightProductRepository;
use App\Repositories\Client\ProjectContractTypeRepository;
use App\Repositories\Client\ProjectFinancingRepository;
use App\Repositories\Client\ResearchUnitRepository;
use App\Repositories\Client\FinancingTypeRepository;
use App\Repositories\Client\IntangibleAssetLocalizationRepository;
use App\Repositories\Client\IntangibleAssetRepository;

use App\Models\Client\IntangibleAsset\IntangibleAsset;

class IntangibleAssetService extends AbstractServiceModel
{
    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    /** @var IntangibleAssetLocalizationRepository */
    protected $intangibleAssetLocalizationRepository;

    /** @var ProjectFinancingRepository */
    protected $projectFinancingRepository;

    /** @var ProjectContractTypeRepository */
    protected $projectContractTypeRepository;

    /** @var FinancingTypeRepository */
    protected $financingTypeRepository;

    /** @var ResearchUnitRepository */
    protected $researchUnitRepository;

    /** @var IntellectualPropertyRightProductRepository */
    protected $intellectualPropertyRightProductRepository;

    public function __construct(
        IntangibleAssetRepository $intangibleAssetRepository,
        IntangibleAssetLocalizationRepository $intangibleAssetLocalizationRepository,
        ProjectFinancingRepository $projectFinancingRepository,
        ProjectContractTypeRepository $projectContractTypeRepository,
        FinancingTypeRepository $financingTypeRepository,
        ResearchUnitRepository $researchUnitRepository,
        IntellectualPropertyRightProductRepository $intellectualPropertyRightProductRepository
    ) {
        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->intangibleAssetLocalizationRepository = $intangibleAssetLocalizationRepository;
        $this->projectFinancingRepository = $projectFinancingRepository;
        $this->projectContractTypeRepository = $projectContractTypeRepository;
        $this->financingTypeRepository = $financingTypeRepository;
        $this->researchUnitRepository = $researchUnitRepository;
        $this->intellectualPropertyRightProductRepository = $intellectualPropertyRightProductRepository;
    }

    /**
     * @param array $params
     * 
     * @return mixed
     */
    public function transformParams($params)
    {
        if (empty($params)) {
            // $params = set_sub_month_date_filter($params, 'date_from', 1);
        }

        # Clean empty keys
        // $params = array_filter($params);

        return $params;
    }

    /**
     * @param $query
     * @param array $params
     * @param int $pageNumber
     * @param int $total
     * 
     * @return LengthAwarePaginator $items
     */
    public function customPagination($query, $params, $pageNumber, $total)
    {
        try {

            $perPage = $this->intangibleAssetRepository->getPerPage();
            $pageName = 'page';
            $offset = ($pageNumber -  1) * $perPage;

            $page = Paginator::resolveCurrentPage($pageName);

            $query->skip($offset)
                ->take($perPage);

            if (isset($params['order_by'])) {
                if ($params['order_by'] == 1) {
                    $query->orderBy("intangible_assets.name", 'ASC');
                } else {
                    $query->orderBy("intangible_assets.name", 'DESC');
                }
            } else {
                $query->orderBy("intangible_assets.name", 'ASC');
            }
            $items = $query->get();

            $items = new LengthAwarePaginator($items, $total, $perPage, $page, [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => $pageName
            ]);

            $items->appends($params);

            return $items;
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * Store a new IntangibleAsset.
     * 
     * @param array $data
     * @return array
     */
    public function save(array $data): array
    {
        $dataCollection = collect($data);
        $data = $dataCollection->only(['project_id', 'name', 'date'])->toArray();
        $localizationData = $dataCollection->only(['localization', 'localization_code'])->toArray();
        $researchUnitIds = $dataCollection->get('research_unit_id');

        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            DB::beginTransaction();
            /** @var \App\Models\Client\IntangibleAsset\IntangibleAsset $item */
            $item = $this->intangibleAssetRepository->create($data);
            $item->research_units()->sync($researchUnitIds);
            $arrayDataLocaliztion = [
                'intangible_asset_id' => $item->id,
                'localization' => $localizationData['localization'],
                'code' => $localizationData['localization_code'],
            ];
            $this->intangibleAssetLocalizationRepository->create($arrayDataLocaliztion);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
        } catch (QueryException $th) {
            dd($th->getMessage());
            DB::rollBack();
        }
        return $response;
    }

    /**
     * Update an Intangible Asset.
     * 
     * @param array $data
     * @param mixed $id
     * @return array
     */
    public function update(array $data, $id): array
    {
        $dataCollection = collect($data);
        $data = $dataCollection->only(['project_id', 'name', 'date'])->toArray();
        $localizationData = $dataCollection->only(['localization', 'localization_code'])->toArray();
        $researchUnitIds = $dataCollection->get('research_unit_id');

        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            DB::beginTransaction();
            /** @var \App\Models\Client\IntangibleAsset\IntangibleAsset $item */
            $item = $this->intangibleAssetRepository->getById($id);
            $this->intangibleAssetRepository->update($item, $data);
            $item->research_units()->sync($researchUnitIds);
            $arrayDataLocaliztion = [
                'intangible_asset_id' => $item->id,
                'localization' => $localizationData['localization'],
                'code' => $localizationData['localization_code'],
            ];
            $intangibleAssetLocaliation = $item->intangible_asset_localization;
            $this->intangibleAssetLocalizationRepository->update($intangibleAssetLocaliation, $arrayDataLocaliztion);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
        } catch (QueryException $th) {
            dd($th->getMessage());
            DB::rollBack();
        }
        return $response;
    }

    /**
     * @param int $id
     * @return array
     */
    public function updateCode(int $id): array
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.client.intangible_assets.messages.update_error')];
        try {
            $item = $this->intangibleAssetRepository->getById($id);

            $this->generateCodeOfIntangibleAsset($item);

            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.intangible_assets.messages.update_success', ['intangible_asset' => $item->name])];
        } catch (\Exception $th) {
            DB::rollBack();
        }
        return $response;
    }

    /**
     * @param IntangibleAsset $intangibleAsset
     * 
     * @return void
     */
    public function generateCodeOfIntangibleAsset($intangibleAsset)
    {
        /** @var \App\Models\Client\FinancingType $financingType */
        $financingType = $this->financingTypeRepository->search(['project_id' => $intangibleAsset->project_id])->first();

        /** @var \App\Models\Client\Project\ProjectFinancing $projectFinancing */
        $projectFinancing = $this->projectFinancingRepository->getByProject($intangibleAsset->project_id)->first();

        /** @var \App\Models\Client\ResearchUnit $researchUnit */
        $researchUnit = $this->researchUnitRepository->search(['project_id' => $intangibleAsset->project_id])->first();

        /** CodePart I */
        $financingTypeCode = $financingType->code;

        /** CodePart II */
        $researchUnitCode = $researchUnit->code;

        /** CodePart III */
        $year = (new Carbon($projectFinancing->date))->year;

        /** CodePart IV */
        $projectContractType = $this->projectContractTypeRepository->getById($intangibleAsset->project->project_contract_type_id);
        $projectContractTypeCode = $projectContractType->code ?? '';

        /** CodePart V */
        $intellectualPropertyRightProduct = $this->intellectualPropertyRightProductRepository->getById($intangibleAsset->classification_id);
        $intellectualPropertyRightProductCode = $intellectualPropertyRightProduct->code;

        $code = "{$financingTypeCode}{$researchUnitCode}{$year}{$projectContractTypeCode}{$intellectualPropertyRightProductCode}";

        $this->intangibleAssetRepository->update($intangibleAsset, ['code' => $code]);
    }

    /**
     * Search Intangible Asset with a Pagination.
     * @param array $data
     * @param int $page
     * @param array $with
     * @param array $withCount
     */
    public function searchWithPagination(array $data, int $page = null, array $with = [], $withCount = []): array
    {
        $params = $this->transformParams($data);
        $query = $this->intangibleAssetRepository->search($params, $with, $withCount);
        $total = $query->count();
        $items = $this->customPagination($query, $params, $page, $total);
        $links = $items->links('pagination.customized');

        return [$params, $total, $items, $links];
    }
}
