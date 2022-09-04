<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'research_unit_id',
        'director_id',
        'name',
        'description',
    ];

    /**
     * Get the research unit.
     * 
     * @return \App\Models\Tenant\ResearchUnit
     */
    public function research_unit()
    {
        return $this->belongsTo(\App\Models\Tenant\ResearchUnit::class, 'research_unit_id');
    }

    /**
     * Get the director.
     * 
     * @return \App\Models\Tenant\Creator
     */
    public function director()
    {
        return $this->belongsTo(\App\Models\Tenant\Creator\Creator::class, 'director_id');
    }

    /**
     * Get projects.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function intangible_assets()
    {
        return $this->hasMany(\App\Models\Tenant\IntangibleAsset\IntangibleAsset::class);
    }
}
