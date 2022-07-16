<?php

namespace App\Models\IntangibleAssetTypes;

use App\Models\BaseModel;

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
    public function intangibleAssetTypeLevel2()
    {
        return $this->hasMany(intangibleAssetTypeLevel2::class);
    }
}
