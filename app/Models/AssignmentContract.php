<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignmentContract extends BaseModel
{
    use HasFactory;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql';

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
            __('admin_pages.creators.assignment_contracts.options.internal') :
            __('admin_pages.creators.assignment_contracts.options.external');
    }
}
