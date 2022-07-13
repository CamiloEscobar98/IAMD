<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalOrganization extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nit', 'name', 'email', 'telephone', 'address'];

    /**
     * Get Creators
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function creators()
    {
        return $this->hasMany(\App\Models\Tenant\Creator::class);
    }
}
