<?php

namespace App\Models\Localization;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * Get State
     * 
     * @return \App\Models\Localization\State
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Get Country
     * 
     * @return \App\Models\Localization\Country
     */
    public function country()
    {
        return $this->hasOneThrough(Country::class, State::class, 'state_id', 'country_id', 'id', 'id');
    }
}
