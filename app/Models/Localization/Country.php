<?php

namespace App\Models\Localization;

use App\Models\BaseModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends BaseModel
{
    use HasFactory;

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 10;

     /**
     * Get items from array.
     * 
     * @var array
     */
    protected $with = ['states', 'cities'];

    /**
     * Get counts from array
     * 
     * @var array
     */
    protected $withCount = ['states', 'cities'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get States.
     * 
     * @return HasMany
     */
    public function states()
    {
        return $this->hasMany(State::class);
    }

    public function cities()
    {
        return $this->hasManyThrough(City::class, State::class);
    }
}
