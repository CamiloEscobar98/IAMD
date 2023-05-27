<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

use App\Models\Client\AdministrativeUnit;
use App\Models\Client\ResearchUnitCategory;
use App\Models\Client\Creator\Creator;
use App\Models\Client\Project\Project;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'academic_department_id',
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
     * @return \App\Models\Client\AdministrativeUnit
     */
    public function administrative_unit()
    {
        return $this->belongsTo(AdministrativeUnit::class);
    }

    /**
     * Get Research Unit Category
     * 
     * @return \App\Models\Client\ResearchUnitCategory
     */
    public function research_unit_category()
    {
        return $this->belongsTo(ResearchUnitCategory::class);
    }

    /**
     * Get the director.
     * 
     * @return \App\Models\Client\Creator\Creator
     */
    public function director()
    {
        return $this->belongsTo(Creator::class, 'director_id');
    }

    /**
     * Get the Inventory Manager.
     * 
     * @return \App\Models\Client\Creator\Creator
     */
    public function inventory_manager()
    {
        return $this->belongsTo(Creator::class, 'inventory_manager_id');
    }

    /**
     * Get projects.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
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
     * Scope a query to only include Code
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $code
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByCode($query, string $code)
    {
        return $query->where("{$this->getTable()}.code", $code);
    }

    /**
     * Scope a query to only include Administrative Unit
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|string $administrativeUnit
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByAdministrativeUnit($query, array|string $administrativeUnit)
    {
        if (is_array($administrativeUnit) && !empty($administrativeUnit)) {
            return $query->whereIn("{$this->getTable()}.administrative_unit_id", $administrativeUnit);
        }

        return $query->where("{$this->getTable()}.administrative_unit_id", $administrativeUnit);
    }

    /**
     * Scope a query to only include Research Unit Category
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|string $researchUnitCategory
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByResearchUnitCategory($query, array|string $researchUnitCategory)
    {
        if (is_array($researchUnitCategory) && !empty($researchUnitCategory)) {
            return $query->whereIn("{$this->getTable()}.research_unit_category_id", $researchUnitCategory);
        }

        return $query->where("{$this->getTable()}.research_unit_category_id", $researchUnitCategory);
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
     * Scope a query to only include Inventory Manager
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|string $director
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByInventoryManager($query, $inventoryManager)
    {
        if (is_array($inventoryManager) && !empty($inventoryManager)) {
            return $query->whereIn("{$this->getTable()}.inventory_manager_id", $inventoryManager);
        }

        return $query->where("{$this->getTable()}.inventory_manager_id", $inventoryManager);
    }

    /**
     * Scope a query to only include Project
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|int $project
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByProject($query, $project)
    {
        $joinResearchUnitProject = 'project_research_unit';
        if (is_array($project) && !empty($project)) {
            return $query->whereIn("{$joinResearchUnitProject}.project_id", $project);
        }

        return $query->where("{$joinResearchUnitProject}.project_id", $project);
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
        $query->where("{$this->getTable()}.created_at", '>=', $dateFrom);
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
        $query->where("{$this->getTable()}.created_at", '<=', $dateTo);
    }

    /**
     * @return bool
     */
    public function hasProjects()
    {
        return $this->projects->count() > 0;
    }
}
