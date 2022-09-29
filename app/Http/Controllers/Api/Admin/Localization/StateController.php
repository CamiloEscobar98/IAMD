<?php

namespace App\Http\Controllers\Api\Admin\Localization;

use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use App\Repositories\Admin\CityRepository;
use App\Repositories\Admin\StateRepository;

use App\Models\Admin\Localization\State;

class StateController extends Controller
{
    /** @var StateRepository */
    protected $stateRepository;

    /** @var CityRepository */
    protected $cityRepository;

    public function __construct(
        StateRepository $stateRepository,
        CityRepository $cityRepository
    ) {
        $this->stateRepository = $stateRepository;
        $this->cityRepository = $cityRepository;
    }

    /**
     * Get all States.
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $items = $this->stateRepository->all();

            return response()->json($items);
        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    /**
     * Get Item
     * 
     * @param State $state 
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function cities(State $state): JsonResponse|String
    {
        try {
            $items = $this->cityRepository->getByState($state);

            return response()->json($items);
        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
