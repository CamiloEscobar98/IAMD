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

use App\Models\Admin\IntangibleAssetState;

use App\Models\Client\Creator\Creator;
use App\Models\Client\Project\Project;
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
     * Relations with the model IntangibleAsset
     */

    /**
     * Get Project.
     * 
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get Intangible Asset State.
     * 
     * @return BelongsTo
     */
    public function intangible_asset_state(): BelongsTo
    {
        return $this->belongsTo(IntangibleAssetState::class);
    }

    /**
     * Get the Intangible Asset Published
     * 
     * @return HasOne
     */
    public function intangible_asset_published(): HasOne
    {
        return $this->hasOne(IntangibleAssetPublished::class);
    }

    /**
     * @return HasOne
     */
    public function intangible_asset_confidenciality_contract()
    {
        return $this->hasOne(IntangibleAssetConfidentialityContract::class);
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
    public function hasProject(): bool
    {
        return !is_null($this->project_id);
    }

    /**
     * @return bool
     */
    public function hasBeenPublished(): bool
    {
        return !is_null($this->intangible_asset_published);
    }

    /**
     * @return bool
     */
    public function hasConfidencialityContract(): bool
    {
        return !is_null($this->intangible_asset_confidenciality_contract);
    }

    /**
     * @return bool
     */
    public function hasFileOfConfidencialityContract(): bool
    {
        /** @var \App\Models\Client\IntangibleAsset\IntangibleAssetConfidentialityContract $confidencialityContract */
        $confidencialityContract = $this->intangible_asset_confidenciality_contract;
        return $this->hasConfidencialityContract() && !is_null($confidencialityContract->file_path && $confidencialityContract->file);
    }

    public function hasDummyFileOfConfidencialityContract(): bool
    {
        /** @var \App\Models\Client\IntangibleAsset\IntangibleAssetConfidentialityContract $confidencialityContract */
        $confidencialityContract = $this->intangible_asset_confidenciality_contract;
        return $this->hasConfidencialityContract() && $confidencialityContract->file == 'example.txt';
    }
}
