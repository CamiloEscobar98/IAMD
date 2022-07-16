<?php

namespace App\Models\Localization;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['country_id', 'name'];
}
