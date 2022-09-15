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
}
