<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Repositories\Admin\IntellectualPropertyRightCategoryRepository;

class IntellectualPropertyRightCategoryController extends Controller
{

    /** @var IntellectualPropertyRightCategoryRepository */
    protected $intellectualPropertyRightCategoryRepository;

    public function __construct(IntellectualPropertyRightCategoryRepository $intellectualPropertyRightCategoryRepository)
    {
        $this->intellectualPropertyRightCategoryRepository = $intellectualPropertyRightCategoryRepository;
    }

    /**
     * Get All
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse|String
    {
        try {
            $items = $this->intellectualPropertyRightCategoryRepository->search([], ['intellectual_property_right_subcategories', 'intellectual_property_right_subcategories.intellectual_property_right_products'])->get();

            return response()->json($items);
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    /**
     * Get Item
     * 
     * @param int $category 
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($category): \Illuminate\Http\JsonResponse|String
    {
        try {
            $item = $this->intellectualPropertyRightCategoryRepository->getByIdWithRelations($category, ['intellectual_property_right_subcategories']);

            return response()->json($item);
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }
}
