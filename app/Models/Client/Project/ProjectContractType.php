<?php

namespace App\Models\Client\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Client\BaseModel;

class ProjectContractType extends BaseModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'code'];

    /**
     * Get the Code Table
     *
     * @param  string  $value
     * @return string
     */
    public function getCodeTableAttribute($value)
    {
        return $this->code ?? __('inputs.empty');
    }
}
