<?php

namespace App\Repositories\Admin;

use App\Repositories\AbstractRepository;

use App\Models\Admin\IntangibleAssetTypeLevel\IntangibleAssetTypeLevel3;

class IntangibleAssetTypeLevel3Repository extends AbstractRepository
{
    public function __construct(IntangibleAssetTypeLevel3 $model)
    {
        $this->model = $model;
    }

    /**
     * @param \App\Models\Admin\IntangibleAssetTypeLevel\IntangibleAssetTypeLevel1 $subCategory
     */
    public function getByIntangibleAssetTypeLevel2($subCategory)
    {
        return $this->all()->where('intangible_asset_type_level2_id', $subCategory->id);
    }
}
