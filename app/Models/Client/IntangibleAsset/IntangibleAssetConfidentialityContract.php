<?php

namespace App\Models\Client\IntangibleAsset;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Client\BaseModel;

class IntangibleAssetConfidentialityContract extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['intangible_asset_id', 'organization_confidenciality', 'file_url', 'file_name'];

    /**
     * Get Intangible Asset
     * 
     * @return BelongsTo
     */
    public function intangible_asset(): BelongsTo
    {
        return $this->belongsTo(IntangibleAsset::class);
    }
}
