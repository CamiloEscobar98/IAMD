<?php

namespace App\Models\Client\IntangibleAsset;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Client\BaseModel;

class IntangibleAssetContability extends BaseModel
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'intangible_asset_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['intangible_asset_id', 'price', 'comments'];

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
