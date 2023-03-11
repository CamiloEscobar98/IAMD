<?php

namespace App\Http\Controllers\Api\Admin\Localization;

use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use App\Repositories\Admin\CountryRepository;
use App\Repositories\Admin\StateRepository;

use Exception;
use Illuminate\Http\Request;
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
     * @param Request $request
     * @return string|JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $countries = $this->countryRepository->search($request->all())->pluck('name', 'id')->prepend('---Seleccionar país', -1);
            return response()->json($countries);
        } catch (Exception $e) {
            Log::error("@Api/Controllers/CountryController:Index/Exception: {$e->getMessage()}");
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
