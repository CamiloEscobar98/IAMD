<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Admin\DocumentTypeRepository;

class DocumentTypeService
{
    /** @var DocumentTypeRepository */
    protected $documentTypeRepository;

    public function __construct(DocumentTypeRepository $documentTypeRepository)
    {
        $this->documentTypeRepository = $documentTypeRepository;
    }

    /**
     * Store a new Document Type.
     * 
     * @param array $data
     * @return array
     */
    public function save(array $data): array
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.creators.document_types.messages.save_error')];
        try {
            DB::beginTransaction();
            $item = $this->documentTypeRepository->create($data);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.creators.document_types.messages.save_success', ['document_type' => $item->name])];
        } catch (QueryException $th) {
            dd($th->getMessage());
            DB::rollBack();
        }
        return $response;
    }

    /**
     * Update a Document Type.
     * 
     * @param array $data
     * @param int $documentTypeId
     * @return array
     */
    public function update(array $data, int $documentTypeId): array
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.creators.document_types.messages.update_error')];
        try {
            DB::beginTransaction();
            $item = $this->documentTypeRepository->getById($documentTypeId);
            $this->documentTypeRepository->update($item, $data);
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.creators.document_types.messages.update_success', ['document_type' => $item->name])];
            DB::commit();
        } catch (QueryException $th) {
            DB::rollBack();
        }
        return $response;
    }

    /**
     * Delete a Document Type.
     * @param int $documentTypeId
     * @return array
     */
    public function delete(int $documentTypeId): array
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.creators.document_types.messages.delete_error')];

        try {
            DB::beginTransaction();
            $item = $this->documentTypeRepository->getById($documentTypeId);
            $this->documentTypeRepository->delete($item);
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

            $perPage = $this->documentTypeRepository->getPerPage();
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
        $query = $this->documentTypeRepository->search($params, $with, $withCount);
        $total = $query->count();
        $items = $this->customPagination($query, $params, $page, $total);
        $links = $items->links('pagination.customized');

        return [$params, $total, $items, $links];
    }
}
