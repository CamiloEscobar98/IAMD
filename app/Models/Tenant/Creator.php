<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\UuidPrimaryModel;

class Creator extends Model
{
    use HasFactory, UuidPrimaryModel;

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
