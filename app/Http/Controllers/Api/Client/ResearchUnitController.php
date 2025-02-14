<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use App\Repositories\Client\ResearchUnitRepository;

use App\Models\Client\ResearchUnit;
use App\Repositories\Client\ProjectRepository;
use Illuminate\Http\Request;

class ResearchUnitController extends Controller
{
    /** @var ResearchUnitRepository */
    protected $researchUnitRepository;

    /** @var ProjectRepository */
    protected $projectRepository;

    public function __construct(
        ResearchUnitRepository $researchUnitRepository,
        ProjectRepository $projectRepository
    ) {
        $this->researchUnitRepository = $researchUnitRepository;
        $this->projectRepository = $projectRepository;
    }

    /**
     * Get All
     * 
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse|String
    {
        try {
            $items = $this->researchUnitRepository->search($request->all())->get();
            return response()->json($items);
        } catch (\Exception $th) {
            
        }
    }

    /**
     * Get Item
     * 
     * @param int $researchUnit 
     * 
     * @return JsonResponse
     */
    public function projects($id, int $research_unit): JsonResponse|String
    {
        try {
            $researchUnit = $this->researchUnitRepository->getById($research_unit);
            
            $items = $this->projectRepository->getByResearchUnit($researchUnit);

            return response()->json($items);
        } catch (\Exception $th) {
            
        }
    }
}
