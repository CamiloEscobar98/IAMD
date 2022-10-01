<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;

use App\Repositories\Client\AdministrativeUnitRepository;
use App\Repositories\Client\ResearchUnitRepository;

use App\Models\Client\AdministrativeUnit;
use Illuminate\Http\JsonResponse;

class AdministrativeUnitController extends Controller
{
    /** @var AdministrativeUnitRepository */
    protected $administrativeUnitRepository;

    /** @var ResearchUnitRepository */
    protected $researchUnitRepository;

    public function __construct(
        AdministrativeUnitRepository $administrativeUnitRepository,
        ResearchUnitRepository $researchUnitRepository,
    ) {
        $this->administrativeUnitRepository = $administrativeUnitRepository;
        $this->researchUnitRepository = $researchUnitRepository;
    }

    /**
     * Get All
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse|String
    {
        try {
            $items = $this->administrativeUnitRepository->all();

            return response()->json($items);
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    /**
     * Get Item
     * 
     * @param int $id
     * @param int $administrative_unit 
     * 
     * @return JsonResponse
     */
    public function research_units($id, $administrative_unit): JsonResponse|String
    {
        try {
            $administrativeUnit = $this->administrativeUnitRepository->getById($administrative_unit);

            $items = $this->researchUnitRepository->getByAdministrativeUnit($administrativeUnit);

            return response()->json($items);
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }
}
