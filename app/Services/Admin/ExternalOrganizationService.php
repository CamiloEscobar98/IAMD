<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Admin\ExternalOrganizationRepository;

class ExternalOrganizationService
{
    /** @var ExternalOrganizationRepository */
    protected $externalOrganizationRepository;

    public function __construct(ExternalOrganizationRepository $externalOrganizationRepository)
    {
        $this->externalOrganizationRepository = $externalOrganizationRepository;
    }

    /**
     * Store a new External Organization.
     * 
     * @param array $data
     * @return array
     */
    public function save(array $data): array
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.creators.document_types.messages.save_error')];
        try {
            DB::beginTransaction();
            $item = $this->externalOrganizationRepository->create($data);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.creators.document_types.messages.save_success', ['document_type' => $item->name])];
        } catch (QueryException $th) {
            dd($th->getMessage());
            DB::rollBack();
        }
        return $response;
    }

    /**
     * Update a External Organization.
     * 
     * @param array $data
     * @param int $externalOrganization
     * @return array
     */
    public function update(array $data, int $externalOrganization): array
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.creators.document_types.messages.update_error')];
        try {
            DB::beginTransaction();
            $item = $this->externalOrganizationRepository->getById($externalOrganization);
            $this->externalOrganizationRepository->update($item, $data);
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.creators.document_types.messages.update_success', ['document_type' => $item->name])];
            DB::commit();
        } catch (QueryException $th) {
            DB::rollBack();
        }
        return $response;
    }

    /**
     * Delete a External Organization.
     * @param int $externalOrganization
     * @return array
     */
    public function delete(int $externalOrganization): array
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.creators.document_types.messages.delete_error')];

        try {
            DB::beginTransaction();
            $item = $this->externalOrganizationRepository->getById($externalOrganization);
            $this->externalOrganizationRepository->delete($item);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.creators.document_types.messages.delete_success', ['document_type' => $item->name])];
        } catch (QueryException $th) {
            DB::rollBack();
        }
        return $response;
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

            $perPage = $this->externalOrganizationRepository->getPerPage();
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
     * @param array $data
     * @param int $page
     * @param array $with
     * @param array $withCount
     * @param int|null $documentTypeId
     */
    public function searchWithPagination(array $data, int $page = null, array $with = [], $withCount = []): array
    {
        $params = $this->transformParams($data);
        $query = $this->externalOrganizationRepository->search($params, $with, $withCount);
        $total = $query->count();
        $items = $this->customPagination($query, $params, $page, $total);
        $links = $items->links('pagination.customized');

        return [$params, $total, $items, $links];
    }
}
