<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\IntangibleAssetTypeLevel2Repository;
use Illuminate\Http\Request;

class IntangibleAssetLevel2Controller extends Controller
{

    /** @var IntangibleAssetTypeLevel2Repository */
    protected $intangibleAssetTypeLevel2Repository;

    public function __construct(IntangibleAssetTypeLevel2Repository $intangibleAssetTypeLevel2Repository)
    {
        $this->intangibleAssetTypeLevel2Repository = $intangibleAssetTypeLevel2Repository;
    }

    /**
     * Get All
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            $items = $this->intangibleAssetTypeLevel2Repository->all();

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
            $item = $this->intangibleAssetTypeLevel2Repository->getByIdWithRelations($intangible_asset_level_2, ['intangible_asset_type_level_3']);

            return response()->json($item);
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }
}
