<?php

namespace App\Models\Client\IntangibleAsset;

use App\Models\Client\BaseModel;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Support\Str;

use App\Traits\Client\IntangibleAsset\HasPhases;

use App\Models\Client\Creator\Creator;
use App\Models\Client\IntangibleAsset\IntangibleAssetDPI;

class IntangibleAsset extends BaseModel
{
    use HasFactory, HasPhases;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'classification_id',
        'intangible_asset_state_id',
        'name',
        'description',
        'code',
        'path',
    ];

    /**
     * Set the Code.
     *
     * @param  string  $value
     * @return void
     */
    public function setCodeAttribute($value)
    {
        return $this->attributes['code'] = Str::upper($value);
    }

    /**
     * Get Project.
     * 
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Client\Project\Project::class);
    }

    /**
     * Get Intangible Asset State.
     * 
     * @return BelongsTo
     */
    public function intangible_asset_state(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Admin\IntangibleAssetState::class);
    }

    /**
     * Get the Intangible Asset Published
     * 
     * @return HasOne
     */
    public function intangible_asset_published(): HasOne
    {
        return $this->hasOne(intangibleAssetPublished::class);
    }

    /**
     * Get all DPIS
     * 
     * @return  HasMany
     */
    public function dpis()
    {
        return $this->hasMany(IntangibleAssetDPI::class);
    }

    /**
     * Get Creators
     * 
     * @return BelongsToMany
     */
    public function creators(): BelongsToMany
    {
        return $this->belongsToMany(Creator::class);
    }

    /**
     * @return bool
     */
    public function HasProject(): bool
    {
        return !is_null($this->project_id);
    }


 
}
