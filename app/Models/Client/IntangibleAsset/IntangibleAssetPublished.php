<?php

namespace App\Models\Client\IntangibleAsset;

use App\Models\Client\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IntangibleAssetPublished extends BaseModel
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
    protected $fillable = [
        'intangible_asset_id',
        'published_in',
        'information_scope',
        'published_at',
    ];

    /**
     * Get the Published At by Format Y-m-d
     *
     * @param  string  $value
     * @return string
     */
    public function getPublishedAtByDefaultAttribute()
    {
        return $this->attributes['published_at']->format('Y-m-d');
    }

    /**
     * Get Intangible Asset.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function intangibleAsset()
    {
        return $this->belongsTo(IntangibleAsset::class);
    }
}
