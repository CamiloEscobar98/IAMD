<?php

namespace App\Models\Admin\Localization;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Znck\Eloquent\Traits\BelongsToThrough;

use App\Models\Admin\BaseModel;

class City extends BaseModel
{
    use HasFactory, BelongsToThrough;

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
    protected $fillable = ['state_id', 'name'];

    /**
     * Get State
     * 
     * @return BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Get Country
     * 
     * @return HasOneThrough
     */
    public function country()
    {
        return $this->belongsToThrough(Country::class, State::class);
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
     * Scope a query to only include State
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|int $stateId
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfState($query, $stateId)
    {
        if (is_array($stateId) && !empty($stateId)) {
            return $query->whereIn($stateId);
        }
        return $query->where('state_id', $stateId);
    }

    /**
     * Scope a query to only include Creator External
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfCreator($query, $creatorId)
    {
        $client = request()->client;
        $table = $this->getTable();
        $joinCreatorDocuments = "{$client}.creator_documents";

        $query->join($joinCreatorDocuments, "{$joinCreatorDocuments}.expedition_place_id", "{$table}.id");

        return  $query->where("{$joinCreatorDocuments}.creator_id", $creatorId);
    }
}
