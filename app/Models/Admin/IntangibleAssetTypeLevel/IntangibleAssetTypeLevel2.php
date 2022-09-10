<?php

namespace App\Models\Admin\IntangibleAssetTypeLevel;

use App\Models\Admin\BaseModel;

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
     * @return intangibleAssetTypeLevel1
     */
    public function intangible_asset_type_level_1()
    {
        return $this->belongsTo(intangibleAssetTypeLevel1::class);
    }

    /**
     * Get Intangible Asset Type Level 3
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function intangible_asset_type_level_3()
    {
        return $this->hasMany(IntangibleAssetTypeLevel3::class);
    }
}
