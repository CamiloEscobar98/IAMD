<?php

namespace App\Models\Client\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


use Database\Factories\Client\ProjectFinancingFactory;

use App\Models\Client\BaseModel;

use App\Models\Client\FinancingType;
use App\Models\Client\Project\ProjectContractType;

class ProjectFinancing extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_financing';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['project_id', 'financing_type_id'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function financing_type()
    {
        return $this->belongsTo(FinancingType::class);
    }

    /**
     * @return BelongsTo
     */
    public function project_contract_type()
    {
        return $this->belongsTo(ProjectContractType::class);
    }

    /**
     * Scope a query to only include Project
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param int $projectId
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByProject($query, $projectId)
    {
        return $query->where("{$this->getTable()}.project_id", $projectId);
    }
}
