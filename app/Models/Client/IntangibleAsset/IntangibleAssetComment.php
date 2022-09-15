<?php

namespace App\Models\Client\IntangibleAsset;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Client\BaseModel;
use App\Models\Client\User;

class IntangibleAssetComment extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['intangible_asset_id', 'user_id', 'message'];

    /**
     * Get Intangible Asset
     * 
     * @return BelongsTo
     */
    public function intangibleAsset(): BelongsTo
    {
        return $this->belongsTo(IntangibleAsset::class);
    }

    /**
     * Get Intangible Asset
     * 
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
