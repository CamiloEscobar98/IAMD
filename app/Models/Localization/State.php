<?php

namespace App\Models\Localization;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends BaseModel
{
    use HasFactory;

    /**
     * Get items from array.
     * 
     * @var array
     */
    protected $with = ['cities'];

    /**
     * Get counts from array
     * 
     * @var array
     */
    protected $withCount = ['cities'];

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
    protected $fillable = ['country_id', 'name'];

    /**
     * Get Country
     * 
     * @return BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get Cities
     * 
     * @return HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
