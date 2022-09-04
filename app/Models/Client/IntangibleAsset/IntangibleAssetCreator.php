<?php

namespace App\Models\Client\IntangibleAsset;

use App\Models\Client\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Client\Creator\Creator;

class IntangibleAssetCreator extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['intangible_asset_id', 'creator_id'];

    /**
     * Get Intangible Asset
     * 
     * @return BelongsTo
     */
    public function intangibleAsset(): BelongsTo
    {
        return $this->belongsTo(intangibleAsset::class);
    }

    /**
     * Get Creator
     * 
     * @return BelongsTo
     */
    public function creator() : BelongsTo
    {
        return $this->belongsTo(Creator::class);
    }
}
