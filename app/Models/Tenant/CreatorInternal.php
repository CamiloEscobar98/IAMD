<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreatorInternal extends Model
{
    use HasFactory;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'tenant';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'creator_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

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
    protected $fillable = ['creator_id', 'linkage_type_id', 'assignment_contracts_id'];

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
