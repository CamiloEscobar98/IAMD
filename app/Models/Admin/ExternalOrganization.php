<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExternalOrganization extends BaseModel
{
    use HasFactory;
    
    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 5;

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
        return $this->hasMany(\App\Models\Client\Creator\Creator::class);
    }
}
