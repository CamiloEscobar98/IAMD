<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CreatorDocument extends Model
{
    use HasFactory;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'tenant';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'creator_id', 'document_type_id', 'document',
        'expedition_department', 'expedition_place',
    ];

    /**
     * Get Creator.
     * 
     * @return \App\Models\Tenant\Creator
     */
    public function creator()
    {
        return $this->belongsTo(Creator::class);
    }

    /**
     * Get Document Type.
     * 
     * @return \App\Models\DocumentType
     */
    public function documentType()
    {
        return $this->belongsTo(\App\Models\DocumentType::class);
    }
}
