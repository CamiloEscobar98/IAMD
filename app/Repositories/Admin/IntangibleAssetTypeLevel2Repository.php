<?php

namespace App\Repositories\Admin;

use App\Repositories\AbstractRepository;

use App\Models\Admin\IntangibleAssetTypeLevel\IntangibleAssetTypeLevel2;

class IntangibleAssetTypeLevel2Repository extends AbstractRepository
{
    public function __construct(IntangibleAssetTypeLevel2 $model)
    {
        $this->model = $model;
    }

    /**
     * @param \App\Models\Admin\IntangibleAssetTypeLevel\IntangibleAssetTypeLevel1 $category
     */
    public function getByIntangibleAssetTypeLevel1($category)
    {
        return  $this->all()->where('intangible_asset_type_level1_id', $category->id);
    }
}
