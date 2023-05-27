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

        /**
     * Scope a query to only include Creator
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|string $value
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByCreator($query, $value)
    {
        if (is_array($value) && !empty($value)) {
            return $query->whereIn("{$this->getTable()}.creator_id", $value);
        }

        return $query->where("{$this->getTable()}.creator_id", $value);
    }

    /**
     * Scope a query to only include Document
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByDocument($query, $value)
    {
        $joinCreatorDocuments = 'creator_documents';
        return $query->where("$joinCreatorDocuments.document", $value);
    }

    /**
     * Scope a query to only include Name
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByName($query, $value)
    {
        $joinCreators = 'creators';
        return $query->where("$joinCreators.name", 'like', '%' . $value . '%');
    }

    /**
     * Scope a query to only include ExternalOrganization
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|string $value
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByExternalOrganization($query, $value)
    {
        if (is_array($value) && !empty($value)) {
            return $query->whereIn("{$this->getTable()}.external_organization_id", $value);
        }

        return $query->where("{$this->getTable()}.external_organization_id", $value);
    }

    /**
     * Scope a query to only include AssignmentContract
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param array|string $value
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByAssignmentContract($query, $value)
    {
        if (is_array($value) && !empty($value)) {
            return $query->whereIn("{$this->getTable()}.assignment_contract_id", $value);
        }

        return $query->where("{$this->getTable()}.assignment_contract_id", $value);
    }

    /**
     * Scope a query to only include Date From
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $dateFrom
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSinceDate($query, string $dateFrom)
    {
        $query->where("{$this->getTable()}.created_at", '>=', $dateFrom);
    }

    /**
     * Scope a query to only include Date To
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $dateTo
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeToDate($query, string $dateTo)
    {
        $query->where("{$this->getTable()}.created_at", '<=', $dateTo);
    }
}
