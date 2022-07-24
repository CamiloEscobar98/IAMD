<?php

namespace App\Models\Localization;

use App\Models\BaseModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Znck\Eloquent\Traits\BelongsToThrough;

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
}
