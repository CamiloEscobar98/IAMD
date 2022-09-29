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
