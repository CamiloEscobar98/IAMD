<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Database\Factories\Admin\ExternalOrganizationFactory;

class ExternalOrganization extends BaseModel
{
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return ExternalOrganizationFactory::new();
    }

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
        return $this->hasMany(\App\Models\Client\Creator\Creator\Creator::class);
    }
}
