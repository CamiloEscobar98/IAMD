<?php

namespace App\Models\Client\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Database\Factories\Client\ProjectFactory;

use App\Models\Client\BaseModel;

class Project extends BaseModel
{
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return ProjectFactory::new();
    }

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 15;

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
     * @return BelongsTo
     */
    public function research_unit(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Client\ResearchUnit::class, 'research_unit_id');
    }

    /**
     * Get the director.
     * 
     * @return BelongsTo
     */
    public function director(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Client\Creator\Creator::class, 'director_id');
    }

    /**
     * Get projects.
     * 
     * @return HasMany
     */
    public function intangible_assets(): HasMany
    {
        return $this->hasMany(\App\Models\Client\IntangibleAsset\IntangibleAsset::class);
    }

    /**
     * @return HasOne
     */
    public function project_financing(): HasOne
    {
        return $this->hasOne(\App\Models\Client\Project\ProjectFinancing::class);
    }

    /**
     * Scope a query to only include Id
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param int $id
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeById($query, int $id)
    {
        return $query->where('id', $id);
    }

    /**
     * Scope a query to only include Name
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
     * Scope a query to only include Research Unit
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|string $researchUnit
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByResearchUnit($query, $researchUnit)
    {
        if (is_array($researchUnit) && !empty($researchUnit)) {
            return $query->whereIn('research_unit_id', $researchUnit);
        }

        return $query->where('research_unit_id', $researchUnit);
    }

    /**
     * Scope a query to only include Research Unit
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|string $administrativeUnit
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByAdministrativeUnit($query, $administrativeUnit)
    {
        $table = $this->getTable();
        $joinResearchUnit = 'research_units';

        $query->join($joinResearchUnit, "{$table}.research_unit_id", "{$joinResearchUnit}.id");

        if (is_array($administrativeUnit) && !empty($administrativeUnit)) {
            return $query->whereIn("{$joinResearchUnit}.administrative_unit_id", $administrativeUnit);
        }

        return $query->where("{$joinResearchUnit}.administrative_unit_id", $administrativeUnit);
    }

    /**
     * Scope a query to only include Director
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|string $director
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByDirector($query, $director)
    {
        if (is_array($director) && !empty($director)) {
            return $query->whereIn('director_id', $director);
        }

        return $query->where('director_id', $director);
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
}
