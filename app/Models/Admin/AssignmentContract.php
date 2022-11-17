<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignmentContract extends BaseModel
{
    use HasFactory;

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 15;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'is_internal'];

    /**
     * Get the option if is internal or no.
     *
     * @return string
     */
    public function getIsInternalNameAttribute()
    {
        return $this->getAttribute('is_internal') ?
            __('pages.admin.creators.assignment_contracts.options.internal') :
            __('pages.admin.creators.assignment_contracts.options.external');
    }
}
