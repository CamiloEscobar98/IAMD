<?php

namespace App\Models\Client\Project;

use App\Models\Client\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectResearchUnit extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_research_unit';
}
