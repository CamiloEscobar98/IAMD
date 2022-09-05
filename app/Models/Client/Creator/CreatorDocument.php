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
     * @return \App\Models\Client\Creator\Creator
     */
    public function creator()
    {
        return $this->belongsTo(Creator::class, 'creator_id');
    }

    /**
     * Get Document Type.
     * 
     * @return \App\Models\Admin\DocumentType
     */
    public function document_type()
    {
        return $this->belongsTo(\App\Models\Admin\DocumentType::class);
    }

    /**
     * Get Expedition Place
     * 
     * @return \App\Models\Admin\Localization\City
     */
    public function expedition_place()
    {
        return $this->belongsTo(\App\Models\Admin\Localization\City::class, 'expedition_place_id');
    }
}
