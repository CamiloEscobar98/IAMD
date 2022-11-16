<?php

namespace App\Models\Admin\Localization;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

use Database\Factories\Admin\Localization\CountryFactory;

use App\Models\Admin\BaseModel;

class Country extends BaseModel
{
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return CountryFactory::new();
    }

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 15;

    /**
     * WithCount property for the model.
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

    /**
     * Get Cities
     * 
     * @return HasManyThrough
     */
    public function cities()
    {
        return $this->hasManyThrough(City::class, State::class);
    }
}
