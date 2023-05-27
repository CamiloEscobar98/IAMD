<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignmentContract extends BaseModel
{
    use HasFactory;

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
    protected $fillable = ['name', 'is_internal'];

    /**
     * Get the option if is internal or no.
     *
     * @return string
     */
    public function getIsInternalNameAttribute()
    {
        return $this->getAttribute('is_internal') ?
            __('pages.admin.creators.assignment_contracts.options.internal') :
            __('pages.admin.creators.assignment_contracts.options.external');
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
