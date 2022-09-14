<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Repositories\Client\ResearchUnitRepository;

class ResearchUnitController extends Controller
{

    /** @var ResearchUnitRepository */
    protected $researchUnitRepository;

    public function __construct(ResearchUnitRepository $researchUnitRepository)
    {
        $this->researchUnitRepository = $researchUnitRepository;
    }

    /**
     * Get All
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse|String
    {
        try {
            $items = $this->researchUnitRepository->search([], ['projects'])->get();

            return response()->json($items);
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    /**
     * Get Item
     * 
     * @param int $research_unit 
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id, $research_unit): \Illuminate\Http\JsonResponse|String
    {
        try {
            $item = $this->researchUnitRepository->getByIdWithRelations($research_unit, ['projects']);

            return response()->json($item);
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }
}
