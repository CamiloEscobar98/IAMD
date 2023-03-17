<?php

namespace App\Http\Controllers\Api\Admin\Localization;

use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use App\Repositories\Admin\CityRepository;
use App\Repositories\Admin\StateRepository;

use Exception;
use Illuminate\Http\Request;
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
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $states = $this->stateRepository->search($request->all())->pluck('name', 'id')->prepend('---Seleccionar departamento', -1);
            return response()->json($states);
        } catch (Exception $e) {
            Log::error("@Api/Controllers/StateController:Index/Exception: {$e->getMessage()}");
            return response()->json([], $e->getCode());
        }
    }
}
