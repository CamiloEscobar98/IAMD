<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;

use App\Repositories\Admin\IntellectualPropertyRightProductRepository;
use App\Repositories\Admin\IntellectualPropertyRightSubcategoryRepository;

use App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightSubcategory;

class IntellectualPropertyRightSubcategoryController extends Controller
{

    /** @var IntellectualPropertyRightSubcategoryRepository */
    protected $intellectualPropertyRightSubcategoryRepository;

    /** @var IntellectualPropertyRightProductRepository */
    protected $intellectualPropertyRightProductRepository;

    public function __construct(
        IntellectualPropertyRightSubcategoryRepository $intellectualPropertyRightSubcategoryRepository,
        IntellectualPropertyRightProductRepository $intellectualPropertyRightProductRepository
    ) {
        $this->intellectualPropertyRightSubcategoryRepository = $intellectualPropertyRightSubcategoryRepository;
        $this->intellectualPropertyRightProductRepository = $intellectualPropertyRightProductRepository;
    }

    /**
     * Get All
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            $items = $this->intellectualPropertyRightSubcategoryRepository->all();

            return response()->json($items);
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    /**
     * Get Item
     * 
     * @param IntellectualPropertyRightSubcategory $subCategory 
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function products(IntellectualPropertyRightSubcategory $subCategory) #: \Illuminate\Http\JsonResponse
    {
        try {
            $item = $this->intellectualPropertyRightProductRepository->getByIntellectualPropertyRightSubcategory($subCategory);

            return response()->json($item);
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }
}
