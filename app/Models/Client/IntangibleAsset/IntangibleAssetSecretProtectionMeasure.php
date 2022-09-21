<?php

namespace App\Models\Client\IntangibleAsset;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Client\BaseModel;

class IntangibleAssetSecretProtectionMeasure extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'intangible_asset_secret_protection_measure';

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
    protected $fillable = ['intangible_asset_id', 'secret_protection_measure_id'];
}
