<?php

namespace App\Services\Client;

use App\Services\AbstractServiceModel;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Client\AdministrativeUnitRepository;
use App\Repositories\Client\IntangibleAssetRepository;
use App\Repositories\Client\ProjectRepository;
use App\Repositories\Client\ResearchUnitRepository;

class AdministrativeUnitService extends AbstractServiceModel
{
    /** @var AdministrativeUnitRepository */
    protected $administrativeUnitRepository;

    /** @var ResearchUnitRepository */
    protected $researchUnitRepository;

    /** @var ProjectRepository */
    protected $projectRepository;

    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    public function __construct(
        AdministrativeUnitRepository $administrativeUnitRepository,
        ResearchUnitRepository $researchUnitRepository,
        ProjectRepository $projectRepository,
        IntangibleAssetRepository $intangibleAssetRepository,
    ) {
        $this->repository = $this->administrativeUnitRepository = $administrativeUnitRepository;
        $this->researchUnitRepository = $researchUnitRepository;
        $this->projectRepository = $projectRepository;
        $this->intangibleAssetRepository = $intangibleAssetRepository;
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

            $perPage = $this->administrativeUnitRepository->getPerPage();
            $pageName = 'page';
            $offset = ($pageNumber -  1) * $perPage;

            $page = Paginator::resolveCurrentPage($pageName);

            $query->skip($offset)
                ->take($perPage);

            if (isset($params['order_by'])) {
                if ($params['order_by'] == 1) {
                    $query->orderBy('name', 'ASC');
                } else {
                    $query->orderBy('name', 'DESC');
                }
            } else {
                $query->orderBy('name', 'ASC');
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

    public function getAdministrativeUnitsSelectByParams(array $params)
    {
        /** Administratvie Units */
        $administrativeUnits =  $this->administrativeUnitRepository->all();

        if (empty($params) || (isset($params['administrative_unit_id']) && $params['administrative_unit_id'] == 0)) {
            $administrativeUnits = $administrativeUnits->pluck('name', 'id')->prepend('---Seleccionar facultad administrativa', 0);

            $researchUnits = collect()->pluck('name', 'id')->prepend('---Seleccionar unidad de investigación', 0);

            $projects = collect()->pluck('name', 'id')->prepend('---Seleccionar proyecto', 0);

            return [$administrativeUnits, $researchUnits, $projects, null, null, null];
        } else {
            if (isset($params['project_id']) && $params['project_id']) {

                /** @var \App\Models\Client\Project\Project $project */
                $project = $this->projectRepository->getById($params['project_id']);

                /** @var \App\Models\Client\ResearchUnit $researchUnit */
                $researchUnit = $this->researchUnitRepository->getById($project->research_unit_id);

                /** @var \App\Models\Client\AdministrativeUnit $administrativeUnit */
                $administrativeUnit = $this->administrativeUnitRepository->getById($researchUnit->administrative_unit_id);

                $researchUnits = $this->researchUnitRepository->getByAdministrativeUnit($administrativeUnit);

                $projects = $this->projectRepository->getByResearchUnit($researchUnit);
            } else if ((isset($params['research_unit_id']) && $params['research_unit_id']) && (isset($params['project_id']) && $params['project_id'] == 0)) {

                $researchUnitId = $params['research_unit_id'];

                /** @var \App\Models\Client\ResearchUnit $researchUnit */
                $researchUnit = $this->researchUnitRepository->getById($researchUnitId);

                /** @var \App\Models\Client\AdministrativeUnit $administrativeUnit */
                $administrativeUnit = $this->administrativeUnitRepository->getById($researchUnit->administrative_unit_id);

                $researchUnits = $this->researchUnitRepository->getByAdministrativeUnit($administrativeUnit);

                $projects = $this->projectRepository->getByResearchUnit($researchUnit);

                $project = null;
            } else {

                $administrativeUnit = $this->administrativeUnitRepository->getById($params['administrative_unit_id']);

                $researchUnits = $this->researchUnitRepository->getByAdministrativeUnit($administrativeUnit);

                $researchUnit = null;

                $projects = collect();

                $project = null;
            }

            $administrativeUnits = $administrativeUnits->pluck('name', 'id')->prepend('---Seleccionar facultad administrativa', 0);

            $researchUnits = $researchUnits->pluck('name', 'id')->prepend('---Seleccionar unidad de investigación', 0);

            $projects = $projects->pluck('name', 'id')->prepend('---Seleccionar proyecto', 0);
        }

        return [$administrativeUnits, $researchUnits, $projects, $administrativeUnit, $researchUnit, $project];
    }

    public function getAdministrativeUnitsSelectByIntangibleAssetForm(int|null $intangibleAssetId)
    {

        /** Administratvie Units */
        $administrativeUnits =  $this->administrativeUnitRepository->all();

        if ($intangibleAssetId) {

            /** @var \App\Models\Client\IntangibleAsset\IntangibleAsset $intangibleAsset */
            $intangibleAsset = $this->intangibleAssetRepository->getById($intangibleAssetId);

            if ($intangibleAsset->hasProject()) {

                /** @var \App\Models\Client\Project\Project */
                $project = $this->projectRepository->getById($intangibleAsset->project_id);

                /** @var \App\Models\Client\ResearchUnit $researchUnit */
                $researchUnit = $this->researchUnitRepository->getById($project->research_unit_id);

                /** @var \App\Models\Client\AdministrativeUnit $administrativeUnit */
                $administrativeUnit = $this->administrativeUnitRepository->getById($researchUnit->administrative_unit->id);

                /** Research Units */
                $researchUnits = $this->researchUnitRepository->getByAdministrativeUnit($administrativeUnit);

                /** Projects */
                $projects = $this->projectRepository->getByResearchUnit($researchUnit);
            }
        } else {

            $params = collect(old())->only(['administrative_unit_id', 'research_unit_id', 'project_id']);

            [$administrativeUnits, $researchUnits, $projects, $administrativeUnit, $researchUnit, $project] = $this->getAdministrativeUnitsSelectByParams($params->toArray());

            return [$administrativeUnits, $researchUnits, $projects, $administrativeUnit, $researchUnit, $project];
        }

        $administrativeUnits = $administrativeUnits->pluck('name', 'id')->prepend('---Seleccionar facultad administrativa', 0);

        $researchUnits = $researchUnits->pluck('name', 'id')->prepend('---Seleccionar unidad de investigación', 0);

        $projects = $projects->pluck('name', 'id')->prepend('---Seleccionar proyecto', 0);

        return [$administrativeUnits, $researchUnits, $projects, $administrativeUnit, $researchUnit, $project];
    }

    public function getAdministrativeUnitsSelectByProjectForm(int|null $projectId)
    {

        /** Administratvie Units */
        $administrativeUnits =  $this->administrativeUnitRepository->all();

        if ($projectId) {

            /** @var \App\Models\Client\Project\Project */
            $project = $this->projectRepository->getById($projectId);

            /** @var \App\Models\Client\ResearchUnit $researchUnit */
            $researchUnit = $this->researchUnitRepository->getById($project->research_unit_id);

            /** @var \App\Models\Client\AdministrativeUnit $administrativeUnit */
            $administrativeUnit = $this->administrativeUnitRepository->getById($researchUnit->administrative_unit->id);

            /** Research Units */
            $researchUnits = $this->researchUnitRepository->getByAdministrativeUnit($administrativeUnit);

            /** Projects */
            $projects = $this->projectRepository->getByResearchUnit($researchUnit);
        } else {

            $params = collect(old())->only(['administrative_unit_id', 'research_unit_id', 'project_id']);

            [$administrativeUnits, $researchUnits, $projects, $administrativeUnit, $researchUnit, $project] = $this->getAdministrativeUnitsSelectByParams($params->toArray());

            return [$administrativeUnits, $researchUnits, $projects, $administrativeUnit, $researchUnit, $project];
        }

        $administrativeUnits = $administrativeUnits->pluck('name', 'id')->prepend('---Seleccionar facultad administrativa', 0);

        $researchUnits = $researchUnits->pluck('name', 'id')->prepend('---Seleccionar unidad de investigación', 0);

        $projects = $projects->pluck('name', 'id')->prepend('---Seleccionar proyecto', 0);

        return [$administrativeUnits, $researchUnits, $projects, $administrativeUnit, $researchUnit, $project];
    }
}
