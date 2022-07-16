<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class IntangibleAssetState extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
