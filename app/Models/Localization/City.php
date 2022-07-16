<?php

namespace App\Models\Localization;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends BaseModel
{
    use HasFactory;

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
