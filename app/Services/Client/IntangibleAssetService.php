<?php

namespace App\Services\Client;

use App\Models\Client\IntangibleAsset\IntangibleAsset;
use App\Repositories\Client\FinancingTypeRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Client\IntangibleAssetRepository;
use App\Repositories\Client\ProjectFinancingRepository;
use App\Repositories\Client\ResearchUnitRepository;
use Illuminate\Support\Carbon;

class IntangibleAssetService
{
    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    /** @var ProjectFinancingRepository */
    protected $projectFinancingRepository;

    /** @var FinancingTypeRepository */
    protected $financingTypeRepository;

    /** @var ResearchUnitRepository */
    protected $researchUnitRepository;

    public function __construct(
        IntangibleAssetRepository $intangibleAssetRepository,
        ProjectFinancingRepository $projectFinancingRepository,
        FinancingTypeRepository $financingTypeRepository,
        ResearchUnitRepository $researchUnitRepository,
    ) {
        $this->intangibleAssetRepository = $intangibleAssetRepository;
        $this->projectFinancingRepository = $projectFinancingRepository;
        $this->financingTypeRepository = $financingTypeRepository;
        $this->researchUnitRepository = $researchUnitRepository;
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
     * @param IntangibleAsset $intangibleAsset
     * @param string $financingTypeCode
     * @param string $researchUnitCode
     * @param 
     */
    public function generateCodeOfIntangibleAsset($intangibleAsset)
    {
        /** @var \App\Models\Client\FinancingType $financingType */
        $financingType = $this->financingTypeRepository->getByProject($intangibleAsset->project_id)->first();

        /** @var \App\Models\Client\Project\ProjectFinancing $projectFinancing */
        $projectFinancing = $this->projectFinancingRepository->getByProject($intangibleAsset->project_id)->first();

        /** @var \App\Models\Client\ResearchUnit $researchUnit */
        $researchUnit = $this->researchUnitRepository->getByProject($intangibleAsset->project_id)->first();

        /** CodePart I */
        $financingTypeCode = $financingType->code;

        /** CodePart II */
        $researchUnitCode = $researchUnit->code;

        /** CodePart III */
        $year = (new Carbon($projectFinancing->date))->year;

        /** CodePart IV */
        $projectContractTypeCode = '';

        /** CodePart V */
        

        $code = "{$financingTypeCode}{$researchUnitCode}{$year}";

        try {
            $this->intangibleAssetRepository->update($intangibleAsset, ['code' => $code]);
        } catch (\Exception $e) {
        }
    }
}
