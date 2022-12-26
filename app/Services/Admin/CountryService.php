<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\StateRepository;
use App\Repositories\Admin\CityRepository;
use Exception;
use Illuminate\Http\RedirectResponse;

class CountryService
{
    /** @var StateService */
    protected $stateService;

    /** @var CountryRepository */
    protected $countryRepository;

    /** @var StateRepository */
    protected $stateRepository;

    /** @var CityRepository */
    protected $cityRepository;

    public function __construct(
        CountryRepository $countryRepository,
        StateRepository $stateRepository,
        CityRepository $cityRepository
    ) {
        $this->countryRepository = $countryRepository;
        $this->stateRepository = $stateRepository;
        $this->cityRepository = $cityRepository;
    }

    /**
     * Store a new Country.
     * 
     * @param array $data
     * @return array
     */
    public function save(array $data): array
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.countries.messages.save_error')];
        try {
            DB::beginTransaction();
            $item = $this->countryRepository->create($data);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.localizations.countries.messages.save_success', ['country' => $item->name])];
        } catch (QueryException $th) {
            DB::rollBack();
        }
        return $response;
    }

    /**
     * Update a Country.
     * 
     * @param array $data
     * @param int $countryId
     * @return array
     */
    public function update(array $data, int $countryId): array
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.countries.messages.update_error')];
        try {
            DB::beginTransaction();
            $item = $this->countryRepository->getById($countryId);
            $this->countryRepository->update($item, $data);
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.localizations.countries.messages.update_success', ['country' => $item->name])];
            DB::commit();
        } catch (QueryException $th) {
            DB::rollBack();
        }
        return $response;
    }

    /**
     * Delete a Country.
     * @param int $countryId
     * @return array
     */
    public function delete(int $countryId): array
    {
        $response = ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.countries.messages.delete_error')];

        try {
            DB::beginTransaction();
            $item = $this->countryRepository->getById($countryId);
            $this->countryRepository->delete($item);
            DB::commit();
            $response = ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.localizations.countries.messages.delete_success', ['country' => $item->name])];
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

            $perPage = $this->countryRepository->getPerPage();
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
     * Search Countries with a Pagination.
     * @param array $data
     * @param int $page
     * @param array $with
     * @param array $withCount
     * @param int|null $countryId
     */
    public function searchWithPagination(array $data, int $page = null, array $with = [], $withCount = []): array
    {
        $params = $this->transformParams($data);
        $query = $this->countryRepository->search($params, $with, $withCount);
        $total = $query->count();
        $items = $this->customPagination($query, $params, $page, $total);
        $links = $items->links('pagination.customized');

        return [$params, $total, $items, $links];
    }

    /**
     * @param mixed $cityId
     */
    public function getCountriesSelect($cityId = null)
    {
        $countries = $this->countryRepository->all();

        if (!is_null($cityId)) {

            $city = $this->cityRepository->getById($cityId);

            $state  = $this->stateRepository->getById($city->state_id);

            $country = $this->countryRepository->getById($state->country_id);

            $states = $this->stateRepository->getByCountry($country);

            $cities = $this->cityRepository->getByState($state);
        } else {
            $country = $countries->where('id', 11)->first();

            $states = $this->stateRepository->getByCountry($country);

            $state = $states->first();

            $cities = $this->cityRepository->getByState($state);

            $city = $cities->first();
        }

        return [$countries, $country, $states, $state, $cities, $city];
    }
}
