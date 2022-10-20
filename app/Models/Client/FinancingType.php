<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class FinancingType extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'code'];

    /**
     * Scope a query to only include Project
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByProject($query, $project)
    {
        $table = $this->getTable();
        $joinProjectFinancing = 'project_financings';

        $query->join($joinProjectFinancing, "{$table}.id", "{$joinProjectFinancing}.financing_type_id");

        if (is_array($project) && !empty($project)) {
            return $query->whereIn("{$joinProjectFinancing}.project_id", $project);
        }

        return $query->where("{$joinProjectFinancing}.project_id", $project);
    }
}
