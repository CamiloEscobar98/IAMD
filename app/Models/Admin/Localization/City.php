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
        $query->where("{$this->getTable()}.updated_at", '>=', $dateFrom);
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
        $query->where("{$this->getTable()}.updated_at", '<=', $dateTo);
    }

    /**
     * Scope a query to only include Country
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfCountry($query, $countryId)
    {
        $joinState = "states";
        if (is_array($countryId) && !empty($countryId)) {
            return $query->whereIn("{$joinState}.country_id", $countryId);
        }
        return $query->where("{$joinState}.country_id", $countryId);
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
        return $query->where("{$this->getTable()}.state_id", $stateId);
    }

    /**
     * Scope a query to only include Creator
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $creatorId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfCreator($query, $creatorId)
    {
        $joinCreatorDocument = "creator_documents";
        if (is_array($creatorId) && !empty($creatorId)) {
            return $query->whereIn("{$joinCreatorDocument}.creator_id", $creatorId);
        }
        return $query->where("{$joinCreatorDocument}.creator_id", $creatorId);
    }
}
