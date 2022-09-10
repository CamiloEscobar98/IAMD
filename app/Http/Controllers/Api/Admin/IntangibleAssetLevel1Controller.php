<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\IntangibleAssetTypeLevel1Repository;
use Illuminate\Http\Request;

class IntangibleAssetLevel1Controller extends Controller
{

    /** @var IntangibleAssetTypeLevel1Repository */
    protected $intangibleAssetTypeLevel1Repository;

    public function __construct(IntangibleAssetTypeLevel1Repository $intangibleAssetTypeLevel1Repository)
    {
        $this->intangibleAssetTypeLevel1Repository = $intangibleAssetTypeLevel1Repository;
    }

    /**
     * Get All
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $items = $this->intangibleAssetTypeLevel1Repository->search([], ['intangible_asset_type_level_2', 'intangible_asset_type_level_2.intangible_asset_type_level_3'])->get();

            return response()->json($items);
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    /**
     * Get Item
     * 
     * @param int $intangible_asset_level_1 
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($intangible_asset_level_1): \Illuminate\Http\JsonResponse
    {
        try {
            $item = $this->intangibleAssetTypeLevel1Repository->getByIdWithRelations($intangible_asset_level_1, ['intangible_asset_type_level_2']);

            return response()->json($item);
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }
}
