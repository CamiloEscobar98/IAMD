<?php

namespace App\Http\Controllers\Api\Admin\Localization;

use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use App\Repositories\Admin\CityRepository;
use App\Repositories\Admin\StateRepository;

use App\Models\Admin\Localization\State;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

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
            $states = $this->stateRepository->all();
            return response()->json($states);
        } catch (Exception $e) {
            Log::error("@Api/Controllers/StateController:Index/Exception: {$e->getMessage()}");
            return response()->json([], $e->getCode());
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
        } catch (ModelNotFoundException $me) {
            Log::error("@Api/Controllers/StateController:GetCities/ModelNotFoundException: {$me->getMessage()}");
            return response()->json([], $me->getCode());
        } catch (Exception $e) {
            Log::error("@Api/Controllers/StateController:GetCities/Exception: {$e->getMessage()}");
            return response()->json([], $e->getCode());
        }
    }
}
