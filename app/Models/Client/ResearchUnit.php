<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class ResearchUnit extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'administrative_unit_id',
        'research_unit_category_id',
        'director_id',
        'inventory_manager_id',
        'name',
        'code',
        'description',
    ];

    /**
     * Set the Code
     *
     * @param  string  $value
     * @return void
     */
    public function setCodeAttribute($value)
    {
        return $this->attributes['code'] = Str::upper($value);
    }

    /**
     * Get Administrative Unit.
     * 
     * @return \App\Models\Tenant\AdministrativeUnit
     */
    public function administrative_unit()
    {
        return $this->belongsTo(\App\Models\Tenant\AdministrativeUnit::class);
    }

    /**
     * Get Research Unit Category
     * 
     * @return \App\Models\Tenant\ResearchUnitCategory
     */
    public function research_unit_category()
    {
        return $this->belongsTo(\App\Models\Tenant\ResearchUnitCategory::class);
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
     * Get the Inventory Manager.
     * 
     * @return \App\Models\Tenant\Creator
     */
    public function inventory_manager()
    {
        return $this->belongsTo(\App\Models\Tenant\Creator\Creator::class, 'inventory_manager_id');
    }

    /**
     * Get projects.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(\App\Models\Tenant\Project::class);
    }
}
