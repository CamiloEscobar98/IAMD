<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AdministrativeUnit extends BaseModel
{
    use HasFactory;

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'info'];

    /**
     * Get the Info
     *
     * @return string
     */
    public function getInformationAttribute()
    {
        return $this->info ?? __('filters.empty');
    }

    /**
     * Get the Research Units
     * 
     * @return HasMany
     */
    public function research_units()
    {
        return $this->hasMany(ResearchUnit::class);
    }
}
