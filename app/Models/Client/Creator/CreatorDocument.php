<?php

namespace App\Models\Client\Creator;

use App\Models\Client\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Traits\UuidPrimaryModel;

class CreatorDocument extends BaseModel
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
    protected $fillable = [
        'creator_id', 'document_type_id', 'document', 'expedition_place_id',
    ];

    /**
     * Get Creator.
     * 
     * @return \App\Models\Tenant\Creator
     */
    public function creator()
    {
        return $this->belongsTo(Creator::class, 'creator_id');
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

    /**
     * Get Expedition Place
     * 
     * @return \App\Models\Localization\City
     */
    public function expeditionPlace()
    {
        return $this->belongsTo(\App\Models\Localization\City::class, 'expedition_place_id');
    }
}
