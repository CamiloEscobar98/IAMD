<?php

namespace App\Http\Controllers\Api\Admin\Localization;

use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use App\Repositories\Admin\CityRepository;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CityController extends Controller
{
    /** @var CityRepository */
    protected $cityRepository;

    public function __construct(
        CityRepository $cityRepository
    ) {
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
            $states = $this->cityRepository->search($request->all())->pluck('name', 'id')->prepend('---Seleccionar ciudad', -1);
            return response()->json($states);
        } catch (Exception $e) {
            Log::error("@Api/Controllers/StateController:Index/Exception: {$e->getMessage()}");
            return response()->json([], $e->getCode());
        }
    }
}
