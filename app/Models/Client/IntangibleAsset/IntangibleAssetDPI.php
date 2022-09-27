<?php

namespace App\Models\Client\IntangibleAsset;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Admin\IntellectualPropertyRight\IntellectualPropertyRightSubcategory as DPI;
use App\Models\Client\BaseModel;

class IntangibleAssetDPI extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'intangible_asset_dpis';

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
    protected $fillable = ['intangible_asset_id', 'dpi_id'];

    /**
     * Get Intangible Asset
     * 
     * @return BelongsTo
     */
    public function intangible_asset(): BelongsTo
    {
        return $this->belongsTo(IntangibleAsset::class);
    }

    public function dpi()
    {
        return $this->belongsTo(DPI::class, 'dpi_id');
    }
}
