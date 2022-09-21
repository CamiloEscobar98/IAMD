<?php

namespace App\Models\Client\IntangibleAsset;

use App\Models\Admin\IntangibleAssetTypeLevel\IntangibleAssetTypeLevel2;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Client\BaseModel;
use App\Models\Client\PriorityTool;

class IntangibleAssetDpiPriorityTool extends BaseModel
{

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
    protected $fillable = ['intangible_asset_id', 'dpi_id', 'priority_tool_id'];

    /**
     * @return BelongsTo
     */
    public function intangible_asset(): BelongsTo
    {
        return $this->belongsTo(IntangibleAsset::class);
    }

    /**
     * @return BelongsTo
     */
    public function dpi(): BelongsTo
    {
        return $this->belongsTo(IntangibleAssetTypeLevel2::class);
    }

    /**
     * @return BelongsTo
     */
    public function priority_tool(): BelongsTo
    {
        return $this->belongsTo(PriorityTool::class);
    }
}
