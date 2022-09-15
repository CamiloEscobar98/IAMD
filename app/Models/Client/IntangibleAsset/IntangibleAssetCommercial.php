<?php

namespace App\Models\Client\IntangibleAsset;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Client\BaseModel;

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
     * @return BelongsTo
     */
    public function intangibleAsset()
    {
        return $this->belongsTo(IntangibleAsset::class);
    }
}
