<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResearchUnitCategory extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get Research Units
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function researchUnits()
    {
        return $this->hasMany(ResearchUnit::class);
    }
}
