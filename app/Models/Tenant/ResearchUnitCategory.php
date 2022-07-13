<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchUnitCategory extends Model
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
