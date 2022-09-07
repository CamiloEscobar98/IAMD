<?php

namespace App\Models\Client\Creator;

use App\Models\Client\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Traits\UuidPrimaryModel;

class CreatorExternal extends BaseModel
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
    protected $fillable = ['creator_id', 'external_organization_id', 'assignment_contract_id'];

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
     * Get External Organization.
     * 
     * @return \App\Models\ExternalOrganization
     */
    public function external_organization()
    {
        return $this->belongsTo(\App\Models\Admin\ExternalOrganization::class);
    }

    /**
     * Get Assignment Contract
     * 
     * @return \App\Models\Admin\AssignmentContract
     */
    public function assignment_contract()
    {
        return $this->belongsTo(\App\Models\Admin\AssignmentContract::class);
    }
}
