<?php

namespace App\Models\Client\Creator;

use App\Models\Client\BaseModel;
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
     * @return \App\Models\Client\Creator\Creator
     */
    public function creator()
    {
        return $this->belongsTo(\App\Models\Client\Creator\Creator::class);
    }

    /**
     * Get Linkage Type.
     * 
     * @return \App\Models\Admin\LinkageType
     */
    public function linkage_type()
    {
        return $this->belongsTo(\App\Models\Admin\LinkageType::class);
    }

    /**
     * Get Assignment Contract.
     * 
     * @return \App\Models\Admin\AssignmentContract
     */
    public function assignment_contract()
    {
        return $this->belongsTo(\App\Models\Admin\AssignmentContract::class);
    }
}
