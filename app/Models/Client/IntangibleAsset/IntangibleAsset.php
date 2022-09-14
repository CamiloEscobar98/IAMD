<?php

namespace App\Models\Client\IntangibleAsset;

use App\Models\Client\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\Client\Creator\Creator;

class IntangibleAsset extends BaseModel
{
    use HasFactory;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(\App\Models\Client\Project::class);
    }

    /**
     * Get Intangible Asset State.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function intangible_asset_state()
    {
        return $this->belongsTo(\App\Models\Admin\IntangibleAssetState::class);
    }

    /**
     * Get the Intangible Asset Published
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function intangibleAssetPublished()
    {
        return $this->hasOne(intangibleAssetPublished::class);
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
    public function hasPhaseOneCompleted(): bool
    {
        return !is_null($this->classification_id);
    }

    /**
     * @return bool
     */
    public function hasPhaseTwoCompleted(): bool
    {
        return !is_null($this->description);
    }

    /**
     * @return bool
     */
    public function hasPhaseThreeCompleted(): bool
    {
        return !is_null($this->intangible_asset_state_id);
    }
}
