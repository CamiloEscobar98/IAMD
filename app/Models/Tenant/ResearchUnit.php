<?php

namespace App\Models\Tenant;

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
    public function administrativeUnit()
    {
        return $this->belongsTo(\App\Models\Tenant\AdministrativeUnit::class);
    }

    /**
     * Get Research Unit Category
     * 
     * @return \App\Models\Tenant\ResearchUnitCategory
     */
    public function researchUnitCategory()
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
        return $this->belongsTo(\App\Models\Tenant\Creator::class, 'director_id');
    }

    /**
     * Get the Inventory Manager.
     * 
     * @return \App\Models\Tenant\Creator
     */
    public function inventoryManager()
    {
        return $this->belongsTo(\App\Models\Tenant\Creator::class, 'inventory_manager_id');
    }
}
