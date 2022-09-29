<?php

namespace App\Http\Controllers\Api\Admin\Localization;

use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\StateRepository;

use App\Models\Admin\Localization\Country;

class CountryController extends Controller
{
    /** @var CountryRepository */
    protected $countryRepository;

    /** @var StateRepository */
    protected $stateRepository;

    public function __construct(
        CountryRepository $countryRepository,
        StateRepository $stateRepository
    ) {
        $this->countryRepository = $countryRepository;
        $this->stateRepository = $stateRepository;
    }

    /**
     * Get all Countries with States and Cities.
     * 
     * @return string|JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $items = $this->countryRepository->all();

            return response()->json($items);
        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    /**
     * Get Item
     * 
     * @param Country $country 
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function states(Country $country): JsonResponse|String
    {
        try {
            $item = $this->stateRepository->getByCountry($country);

            return response()->json($item);
        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
