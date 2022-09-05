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
     * Get External Organization.
     * 
     * @return \App\Models\ExternalOrganization
     */
    public function externalOrganization()
    {
        return $this->belongsTo(\App\MOdels\ExternalOrganization::class);
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
