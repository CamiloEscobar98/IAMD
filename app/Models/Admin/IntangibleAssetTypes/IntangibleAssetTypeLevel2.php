<?php

namespace App\Models\Admin\IntangibleAssetTypes;

use App\Models\BaseModel;

class IntangibleAssetTypeLevel2 extends BaseModel
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['intangible_asset_type_level1_id', 'name'];

    /**
     * Get Intangible Asset Type Level 1
     * 
     * @return \App\Models\IntangibleAssetTypeLevel1
     */
    public function intangibleAssetTypeLevel1()
    {
        return $this->belongsTo(intangibleAssetTypeLevel1::class);
    }
}
