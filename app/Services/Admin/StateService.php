<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Admin\StateRepository;

class StateService
{
    /** @var StateRepository */
    protected $stateRepository;

    public function __construct(StateRepository $stateRepository)
    {
        $this->stateRepository = $stateRepository;
    }

    /**
     * Store a new State.
     * 
     * @param array $data
     * @return array
     */
    public function save(array $data): array
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.states.messages.save_error')];
        try {
            DB::beginTransaction();
            $item = $this->stateRepository->create($data);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.localizations.states.messages.save_success', ['state' => $item->name])];
        } catch (QueryException $th) {
            DB::rollBack();
        }
        return $response;
    }

    /**
     * Update a State.
     * 
     * @param array $data
     * @param int $stateId
     * @return array
     */
    public function update(array $data, int $stateId): array
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.states.messages.update_error')];
        try {
            DB::beginTransaction();
            $item = $this->stateRepository->getById($stateId);
            $this->stateRepository->update($item, $data);
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.localizations.states.messages.update_success', ['state' => $item->name])];
            DB::commit();
        } catch (QueryException $th) {
            DB::rollBack();
        }
        return $response;
    }

    /**
     * Delete a State.
     * @param int $stateId
     * @return array
     */
    public function delete(int $stateId): array
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.states.messages.delete_error')];

        try {
            DB::beginTransaction();
            $item = $this->stateRepository->getById($stateId);
            $this->stateRepository->delete($item);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.localizations.states.messages.delete_success', ['state' => $item->name])];
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
        }

        # Clean empty keys
        $params = array_filter($params);

        return $params;
    }

    /**
     * @param $query
     * @param array $params
     * @param int $perPage
     * @param int $pageNumber
     * @param int $total
     * 
     * @return LengthAwarePaginator $items
     */
    public function customPagination($query, $params, $perPage = null, $pageNumber, $total)
    {
        try {

            $perPage = isset($perPage) && $perPage ? $perPage : $this->stateRepository->getPerPage();
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
            $query->orderBy('country_id', 'ASC');
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
     * @param int|null $countryId
     */
    public function searchWithPagination(array $data, int $page = null, array $with = [], $withCount = [], int|null $countryId = null): array
    {
        $params = $this->transformParams($data);
        $query = $this->stateRepository->search($params, $with, $withCount, $countryId);
        $total = $query->count();
        $items = $this->customPagination($query, $params, 10, $page, $total);
        $links = $items->links('pagination.customized');

        return [$params, $total, $items, $links];
    }
}
