<?php

namespace App\Models\IntangibleAssetTypes;

use Illuminate\Database\Eloquent\Model;

class IntangibleAssetTypeLevel3 extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql';

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
    protected $fillable = ['intangible_asset_type_level2_id', 'name'];

    /**
     * Get Intangible Asset Type Level 2
     * 
     * @return intangibleAssetTypeLevel2
     */
    public function intangibleAssetTypeLevel2()
    {
        return $this->belongsTo(intangibleAssetTypeLevel2::class);
    }
}
