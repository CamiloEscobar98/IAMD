<?php

namespace App\Models\Tenant\Creator;

use App\Models\Tenant\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Traits\UuidPrimaryModel;

class Creator extends BaseModel
{
    use HasFactory, UuidPrimaryModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'phone', 'email'];

    /**
     * Get The Document
     * 
     * @return CreatorDocument
     */
    public function document()
    {
        return $this->hasOne(CreatorDocument::class);
    }
}
