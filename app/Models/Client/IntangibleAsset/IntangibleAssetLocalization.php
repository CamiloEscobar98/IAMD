<?php

namespace App\Models\Client\IntangibleAsset;

use App\Models\Client\BaseModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IntangibleAssetLocalization extends BaseModel
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
    protected $fillable = ['intangible_asset_id', 'localization', 'code'];

    /**
     * Get Intangible Asset information.
     * 
     * @return BelongsTo
     */
    public function intangibleAsset(): BelongsTo
    {
        return $this->belongsTo(IntangibleAsset::class);
    }
}
