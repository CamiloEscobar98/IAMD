<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriorityTool extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * Get the Description Table
     *
     * @return string
     */
    public function getDescriptionTableAttribute()
    {
        return $this->getAttribute('description') ?? __('inputs.empty');
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
