<?php

namespace App\Models\Client\IntangibleAsset;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Client\BaseModel;

class IntangibleAssetProtectionAction extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['intangible_asset_id', 'reference', 'steps'];

    /**
     * Get Intangible Asset
     * 
     * @return BelongsTo
     */
    public function intangibleAsset(): BelongsTo
    {
        return $this->belongsTo(IntangibleAsset::class);
    }
}
