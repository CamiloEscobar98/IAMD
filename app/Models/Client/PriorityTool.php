<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriorityTool extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * Get the Description Table
     *
     * @return string
     */
    public function getDescriptionTableAttribute()
    {
        return $this->getAttribute('description') ?? __('inputs.empty');
    }
}
