<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class IntangibleAssetState extends BaseModel
{
    use HasFactory;

    public const STATE_IDENTIFIED_PROTECTED = 'identificado y protegido';
    public const STATE_IDENTIFIED_NO_PROTECTED = 'identificado y no protegido';
    public const STATE_NO_PROTECTED = 'no protegido';
    public const STATE_IDENTIFIED_PROTECTION_IN_PROGRESS = 'identificado y en proceso de protección';

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
    protected $fillable = ['name', 'description'];
}
