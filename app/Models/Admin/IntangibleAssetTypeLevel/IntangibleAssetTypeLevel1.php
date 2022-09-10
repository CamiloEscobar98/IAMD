<?php

namespace App\Models\Admin\IntangibleAssetTypeLevel;

use App\Models\Admin\BaseModel;

class IntangibleAssetTypeLevel1 extends BaseModel
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
    protected $fillable = ['name'];

    /**
     * Get Level 2
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function intangible_asset_type_level_2()
    {
        return $this->hasMany(IntangibleAssetTypeLevel2::class);
    }
}
