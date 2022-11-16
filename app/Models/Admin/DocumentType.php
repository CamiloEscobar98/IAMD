<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentType extends BaseModel
{
    use HasFactory;

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 15;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug'];
}
