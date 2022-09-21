<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class StrategyCategory extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];
}
