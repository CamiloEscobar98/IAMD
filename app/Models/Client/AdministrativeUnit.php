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

    /**
     * Scope a query to only include Bane
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $name
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByName($query, string $name)
    {
        $query->where('name', 'like', "%{$name}%");
    }

    /**
     * Scope a query to only include Date From
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $dateFrom
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSinceDate($query, string $dateFrom)
    {
        $query->where('updated_at', '>=', $dateFrom);
    }

    /**
     * Scope a query to only include Date To
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $dateTo
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeToDate($query, string $dateTo)
    {
        $query->where('updated_at', '<=', $dateTo);
    }

    /**
     * @return bool
     */
    public function hasResearchUnits()
    {
        return $this->research_units->count() > 0;
    }
}
