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
     * @param  string  $value
     * @return string
     */
    public function getDescriptionTableAttribute($value)
    {
        return $this->description ?? __('inputs.empty');
    }
}
