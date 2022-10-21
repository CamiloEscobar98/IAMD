<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Models\Permission;

class PermissionModule extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Get all permissions.
     * 
     * @return HasMany
     */
    public function permissions() : HasMany
    {
        return $this->hasMany(Permission::class);
    }
}
