<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\IntellectualPropertyRightSubcategoryRepository;
use Illuminate\Http\Request;

class IntellectualPropertyRightSubcategoryController extends Controller
{

   /** @var IntellectualPropertyRightSubcategoryRepository */
    protected $intellectualPropertyRightSubcategoryRepository;

    public function __construct(IntellectualPropertyRightSubcategoryRepository $intellectualPropertyRightSubcategoryRepository)
    {
        $this->intellectualPropertyRightSubcategoryRepository = $intellectualPropertyRightSubcategoryRepository;
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
     * @param int $intangible_asset_level_2 
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($intangible_asset_level_2)#: \Illuminate\Http\JsonResponse
    {
        try {
            $item = $this->intellectualPropertyRightSubcategoryRepository->getByIdWithRelations($intangible_asset_level_2, ['intellectual_property_right_products']);

            return response()->json($item);
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }
}
