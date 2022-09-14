<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Repositories\Client\AdministrativeUnitRepository;

class AdministrativeUnitController extends Controller
{

    /** @var AdministrativeUnitRepository */
    protected $administrativeUnitRepository;

    public function __construct(AdministrativeUnitRepository $administrativeUnitRepository)
    {
        $this->administrativeUnitRepository = $administrativeUnitRepository;
    }

    /**
     * Get All
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse|String
    {
        try {
            $items = $this->administrativeUnitRepository->search([], ['research_units', 'research_units.projects'])->get();

            return response()->json($items);
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    /**
     * Get Item
     * 
     * @param int $admnistrative_unit 
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id, $admnistrative_unit): \Illuminate\Http\JsonResponse|String
    {
        try {
            $item = $this->administrativeUnitRepository->getByIdWithRelations($admnistrative_unit, ['research_units']);

            return response()->json($item);
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }
}
