<?php

namespace App\Models\Tenant\Creator;

use App\Models\Tenant\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Traits\UuidPrimaryModel;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\Tenant\IntangibleAsset\IntangibleAsset;

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
     * Get The Document.
     * 
     * @return HasOne
     */
    public function document() : HasOne
    {
        return $this->hasOne(CreatorDocument::class);
    }

    /**
     * Get Intangible Assets.
     * 
     * @return BelongsToMany
     */
    public function intangibleAssets() : BelongsToMany
    {
        return $this->belongsToMany(IntangibleAsset::class);
    }
}
