<?php

namespace App\Services\Client;

use App\Repositories\Client\ProjectFinancingRepository;
use App\Services\AbstractServiceModel;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Client\ProjectRepository;

class ProjectService extends AbstractServiceModel
{
    /** @var ProjectRepository */
    protected $projectRepository;

    /** @var ProjectFinancingRepository */
    protected $projectFinancingRepository;

    public function __construct(
        ProjectRepository $projectRepository,
        ProjectFinancingRepository $projectFinancingRepository
    ) {
        $this->repository = $this->projectRepository = $projectRepository;
        $this->projectFinancingRepository = $projectFinancingRepository;
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
        $params = array_filter($params);

        // dd($params);

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

            $perPage = $this->projectRepository->getPerPage();
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

    /**
     * Store a new resource.
     * 
     * @param array $data
     * @return array
     */
    public function save(array $data): array
    {
        $data = collect($data);
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.save-error')];
        try {
            $dataProject = $data->only(['project_contract_type_id', 'director_id', 'name', 'description', 'contract', 'date'])->toArray();

            DB::beginTransaction();

            /** @var \App\Models\Client\Project\Project $item */
            $item = $this->projectRepository->create($dataProject);

            $item->research_units()->sync($data->get('research_unit_id'));

            $item->project_financings()->sync($data->get('financing_type_id'));

            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
        } catch (QueryException $th) {
            DB::rollBack();
        }
        return $response;
    }

    /**
     * Update a resource.
     * 
     * @param array $data
     * @param mixed $id
     * @return array
     */
    public function update(array $data, mixed $id): array
    {
        $data = collect($data);
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.update-error')];
        try {
            $dataProject = $data->only(['project_contract_type_id', 'director_id', 'name', 'description', 'contract', 'date'])->toArray();

            /** @var \App\Models\Client\Project\Project $item */
            $item = $this->projectRepository->getById($id);

            DB::beginTransaction();

            $this->projectRepository->update($item, $dataProject);

            $item->research_units()->sync($data->get('research_unit_id'));

            $item->project_financings()->sync($data->get('financing_type_id'));

            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.save-success')];
        } catch (QueryException $th) {
            DB::rollBack();
        }
        return $response;
    }

    /**
     * Search Administrative Units with a Pagination.
     * @param array $data
     * @param int $page
     * @param array $with
     * @param array $withCount
     */
    public function searchWithPagination(array $data, int $page = null, array $with = [], $withCount = []): array
    {
        $params = $this->transformParams($data);
        $query = $this->projectRepository->search($params, $with, $withCount);
        $total = $query->count();
        $items = $this->customPagination($query, $params, $page, $total);
        $links = $items->links('pagination.customized');

        // dd($total);
        return [$params, $total, $items, $links];
    }
}
