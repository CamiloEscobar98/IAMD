<?php

namespace App\Services\Admin;

use App\Repositories\Admin\CityRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\StateRepository;

class CountryService
{
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
