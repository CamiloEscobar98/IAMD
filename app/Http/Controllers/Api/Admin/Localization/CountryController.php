<?php

namespace App\Http\Controllers\Api\Admin\Localization;

use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\StateRepository;

use App\Models\Admin\Localization\Country;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

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
            $countries = $this->countryRepository->all()->pluck('name', 'id')->prepend('---Seleccionar país', -1);
            return response()->json($countries);
        } catch (Exception $e) {
            Log::error("@Api/Controllers/CountryController:Index/Exception: {$e->getMessage()}");
            return response()->json($e->getMessage(), $e->getCode());
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
            $states = $this->stateRepository->getByCountry($country)->pluck('name', 'id')->prepend('---Seleccionar departamento', -1);
            return response()->json($states);
        } catch (ModelNotFoundException $me) {
            Log::error("@Api/Controllers/CountryController:GetStates/ModelNotFoundException: {$me->getMessage()}");
            return response()->json([], $me->getCode());
        } catch (Exception $e) {
            Log::error("@Api/Controllers/CountryController:GetStates/Exception: {$e->getMessage()}");
            return response()->json([], $e->getCode());
        }
    }
}
