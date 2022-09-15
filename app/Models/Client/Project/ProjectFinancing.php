<?php

namespace App\Models\Client\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Database\Factories\Client\ProjectFinancingFactory;

use App\Models\Client\BaseModel;

class ProjectFinancing extends BaseModel
{
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    protected static function newFactory()
    {
        return ProjectFinancingFactory::new();
    }

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'project_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['project_id', 'financing_type_id', 'project_contract_type_id', 'contract', 'date'];

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
        return $this->belongsTo(\App\Models\Client\FinancingType::class);
    }

    /**
     * @return BelongsTo
     */
    public function project_contract_type()
    {
        return $this->belongsTo(\App\Models\Client\Project\ProjectContractType::class);
    }
}
