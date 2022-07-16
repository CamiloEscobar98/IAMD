<?php

namespace App\Models\Tenant\Creator;

use App\Models\Tenant\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Traits\UuidPrimaryModel;

class CreatorInternal extends BaseModel
{
    use HasFactory, UuidPrimaryModel;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'creator_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['creator_id', 'linkage_type_id', 'assignment_contract_id'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['creator'];

    /**
     * Get Creator.
     * 
     * @return \App\Models\Tenant\Creator
     */
    public function creator()
    {
        return $this->belongsTo(\App\Models\Tenant\Creator::class);
    }

    /**
     * Get Linkage Type.
     * 
     * @return \App\Models\LinkageType
     */
    public function linkageType()
    {
        return $this->belongsTo(\App\Models\LinkageType::class);
    }

    /**
     * Get Assignment Contract.
     * 
     * @return \App\Models\AssignmentContract
     */
    public function assignmentContract()
    {
        return $this->belongsTo(\App\Models\AssignmentContract::class);
    }
}
