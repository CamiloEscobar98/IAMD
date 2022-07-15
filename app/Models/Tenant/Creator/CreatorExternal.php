<?php

namespace App\Models\Tenant\Creator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\UuidPrimaryModel;

class CreatorExternal extends Model
{
    use HasFactory, UuidPrimaryModel;

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
     * @return \App\Models\AssignmentContract
     */
    public function assignmentContract()
    {
        return $this->belongsTo(\App\Models\AssignmentContract::class);
    }
}
