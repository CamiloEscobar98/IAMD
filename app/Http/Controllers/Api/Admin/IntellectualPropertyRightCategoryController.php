<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use App\Repositories\Admin\IntellectualPropertyRightCategoryRepository;
use App\Repositories\Admin\IntellectualPropertyRightSubcategoryRepository;

use App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightCategory;

class IntellectualPropertyRightCategoryController extends Controller
{

    /** @var IntellectualPropertyRightCategoryRepository */
    protected $intellectualPropertyRightCategoryRepository;

    /** @var IntellectualPropertyRightSubcategoryRepository */
    protected $intellectualPropertyRightSubcategoryRepository;

    public function __construct(
        IntellectualPropertyRightCategoryRepository $intellectualPropertyRightCategoryRepository,
        IntellectualPropertyRightSubcategoryRepository $intellectualPropertyRightSubcategoryRepository
    ) {
        $this->intellectualPropertyRightCategoryRepository = $intellectualPropertyRightCategoryRepository;
        $this->intellectualPropertyRightSubcategoryRepository = $intellectualPropertyRightSubcategoryRepository;
    }

    /**
     * Get All
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse|String
    {
        try {
            $items = $this->intellectualPropertyRightCategoryRepository->all();

            return response()->json($items);
        } catch (\Exception $th) {
            
        }
    }

    /**
     * Get Item
     * 
     * @param int $category 
     * 
     * @return JsonResponse
     */
    public function subcategories($category): JsonResponse|String
    {
        try {
            $intellectualPropertyRightCategory = $this->intellectualPropertyRightCategoryRepository->getById($category);
            $items = $this->intellectualPropertyRightSubcategoryRepository->getByIntellectualPropertyRightCategory($intellectualPropertyRightCategory);

            return response()->json($items);
        } catch (\Exception $th) {
            
        }
    }
}
