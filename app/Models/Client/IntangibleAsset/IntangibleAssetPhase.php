<?php

namespace App\Models\Client\IntangibleAsset;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Client\BaseModel;

class IntangibleAssetPhase extends BaseModel
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'intangible_asset_id';

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
    protected $fillable = [
        'intangible_asset_id',

        'has_strategies',

        'phase_one_completed',
        'phase_two_completed',
        'phase_three_completed',
        'phase_four_completed',
        'phase_five_completed',
        'phase_six_completed',
        'phase_seven_completed',
        'phase_eight_completed',
        'phase_nine_completed',
    ];

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
