<?php

namespace App\Models\Client\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Database\Factories\Client\ProjectFactory;

use App\Models\Client\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'director_id',
        'name',
        'description',
        'project_contract_type_id', 'contract', 'date'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Get the research units.
     * 
     * @return BelongsToMany
     */
    public function research_units(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Client\ResearchUnit::class, 'project_research_unit');
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
     * @return BelongsTo
     */
    public function contract_type(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Client\Project\ProjectContractType::class, 'project_contract_type_id');
    }

    /**
     * @return BelongsToMany
     */
    public function project_financings(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Client\FinancingType::class, 'project_financing', null, 'financing_type_id');
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
        return $query->where("{$this->getTable()}.id", $id);
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
        $query->where("{$this->getTable()}.name", 'like', "%{$name}%");
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
        $joinResearchUnitProject = 'project_research_unit';
        if (is_array($researchUnit) && !empty($researchUnit)) {
            return $query->whereIn("{$joinResearchUnitProject}.research_unit_id", $researchUnit);
        }
        return $query->where("{$joinResearchUnitProject}.research_unit_id", $researchUnit);
    }

    /**
     * Scope a query to only include Administrative Unit
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByAdministrativeUnit($query, $administrativeUnit)
    {
        $joinResearchUnit = 'research_units';
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
            return $query->whereIn("{$this->getTable()}.director_id", $director);
        }

        return $query->where("{$this->getTable()}.director_id", $director);
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
        $query->where("{$this->getTable()}.date", '>=', $dateFrom);
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
        $query->where("{$this->getTable()}.date", '<=', $dateTo);
    }
}
