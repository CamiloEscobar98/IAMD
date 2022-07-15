<?php

namespace App\Models\Tenant\IntangibleAsset;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class IntangibleAsset extends Model
{
    use HasFactory;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'tenant';

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
     * @return \App\Models\Tenant\Project
     */
    public function project()
    {
        return $this->belongsTo(\App\Models\Tenant\Project::class);
    }

    /**
     * Get Intangible Asset State.
     * 
     * @return \App\Models\IntangibleAssetState
     */
    public function intangibleAssetState()
    {
        return $this->belongsTo(\App\Models\IntangibleAssetState::class);
    }
}
