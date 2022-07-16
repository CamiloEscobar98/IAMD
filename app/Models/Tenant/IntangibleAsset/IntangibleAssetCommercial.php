<?php

namespace App\Models\Tenant\IntangibleAsset;

use App\Models\Tenant\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IntangibleAssetCommercial extends BaseModel
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'intangible_asset_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['intangible_asset_id', 'reason'];


    /**
     * Get Intangible Asset.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function intangibleAsset()
    {
        return $this->belongsTo(IntangibleAsset::class);
    }
}
