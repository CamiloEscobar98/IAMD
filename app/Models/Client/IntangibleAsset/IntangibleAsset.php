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
        return $this->belongsTo(\App\Models\Tenant\Project::class);
    }

    /**
     * Get Intangible Asset State.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function intangibleAssetState()
    {
        return $this->belongsTo(\App\Models\IntangibleAssetState::class);
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
    public function creators() : BelongsToMany
    {
        return $this->belongsToMany(Creator::class);
    }
}
